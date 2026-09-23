<?php
session_start();
require_once '../config/database.php';

// Endpoint ini normalnya menerima HTTP POST webhook dari Midtrans.
// Namun untuk keperluan simulasi/demo tugas ini, kita menerima GET request.

if(isset($_GET['order_id']) && isset($_GET['status_code'])){
    $invoice_number = $_GET['order_id'];
    $status_code = $_GET['status_code'];
    
    if($status_code == '200') {
        try {
            $pdo->beginTransaction();
            
            // Update Invoice
            $stmt = $pdo->prepare("UPDATE invoices SET status = 'PAID' WHERE invoice_number = ?");
            $stmt->execute([$invoice_number]);
            
            // Get Appointment ID to update its status
            $stmt = $pdo->prepare("SELECT id, appointment_id, total_amount FROM invoices WHERE invoice_number = ?");
            $stmt->execute([$invoice_number]);
            $inv = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($inv && $inv['appointment_id']) {
                $stmt = $pdo->prepare("UPDATE appointments SET status = 'CONFIRMED' WHERE id = ?");
                $stmt->execute([$inv['appointment_id']]);
                
                // Add payment record
                $stmt = $pdo->prepare("INSERT INTO payments (invoice_id, amount, payment_method, status) VALUES (?, ?, 'MIDTRANS', 'SUCCESS')");
                $stmt->execute([$inv['id'], $inv['total_amount']]);
            }
            
            $pdo->commit();
            
            // Redirect back to billing
            echo "<script>alert('Pembayaran Berhasil Dikonfirmasi!'); window.location.href = '../index.php?page=billing';</script>";
        } catch(PDOException $e) {
            $pdo->rollBack();
            echo "Error updating database: " . $e->getMessage();
        }
    }
} else {
    echo "Invalid Request";
}
?>
