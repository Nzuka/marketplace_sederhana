<!DOCTYPE html>
<html>
<head>
    <title>Invoice Form</title>
</head>
<body>
    <h2>Invoice Form</h2>
    <form method="post">
        <label for="invoice_number">Invoice Number:</label><br>
        <input type="text" id="invoice_number" name="invoice_number" value="<?php echo generateInvoiceNumber(); ?>" readonly><br><br>
        
        <label for="order_date">Order Date:</label><br>
        <input type="date" id="order_date" name="order_date" value="<?php echo date('Y-m-d'); ?>"><br><br>
        
        <label for="product_name">Product Name:</label><br>
        <input type="text" id="product_name" name="product_name"><br><br>
        
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price"><br><br>
        
        <label for="quantity">Quantity:</label><br>
        <input type="number" id="quantity" name="quantity"><br><br>
        
        <input type="submit" value="Add Product">
    </form>

    <?php
    // Fungsi untuk menghasilkan nomor invoice
    function generateInvoiceNumber() {
        return 'INV' . date('YmdHis');
    }

    // Fungsi untuk menghitung total harga pesanan
    function calculateTotal($items) {
        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    // Memeriksa apakah ada input dari form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Inisialisasi array untuk menyimpan item pesanan
        $items = [];

        // Menambahkan item pesanan dari form ke dalam array
        $items[] = array(
            'name' => $_POST['product_name'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity']
        );

        // Menampilkan invoice
        echo "<h2>Invoice</h2>";
        echo "<p>Invoice Number: {$_POST['invoice_number']}</p>";
        echo "<p>Order Date: {$_POST['order_date']}</p>";
        echo "<table border='1'>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>";
        foreach ($items as $item) {
            $total = $item['price'] * $item['quantity'];
            echo "<tr>
                    <td>{$item['name']}</td>
                    <td>{$item['price']}</td>
                    <td>{$item['quantity']}</td>
                    <td>$total</td>
                </tr>";
        }
        echo "</table>";
        echo "<p>Total Price: " . calculateTotal($items) . "</p>";
    }
    ?>
</body>
</html>