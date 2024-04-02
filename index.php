<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["photo"])) {
    if ($_FILES["photo"]["error"] == 0) {
        $uploadDir = "img/"; 
        $uploadFile = $uploadDir . basename($_FILES["photo"]["name"]);

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $uploadFile)) {
            $xml = new DomDocument('1.0');
            
            $books = $xml->createElement("books");
            $xml->appendChild($books);
            
            $book = $xml->createElement("book");
            $books->appendChild($book);
            $book->setAttribute("id", 1);
            
            $name = $xml->createElement("name", "Java");
            $book->appendChild($name);
            
            $price = $xml->createElement("price", "200");
            $book->appendChild($price);

            $photo = $xml->createElement("photo", $uploadFile);
            $book->appendChild($photo);

            $book = $xml->createElement("book");
            $books->appendChild($book);
            $book->setAttribute("id", 2);
            
            $name = $xml->createElement("name", "PHP");
            $book->appendChild($name);
            
            $price = $xml->createElement("price", "300");
            $book->appendChild($price);

            $photo = $xml->createElement("photo", $uploadFile);
            $book->appendChild($photo);

            $xml->save("book.xml") or die("XML файл үүсгэхэд алдаа гарлаа");

            echo "XML файл амжилттай үүслээ.";
        } else {
            echo "Zurag aldaatai.";
        }
    } else {
        echo "aldaaa: " . $_FILES["photo"]["error"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="photo" id="photo">
        <input type="submit" value="Photo" name="submit">
    </form>
</body>
</html>
