<?
if((isset($_POST["book"]) && $_POST["book"]!="")OR (isset($_POST["author"]) && $_POST["author"]!="") OR (isset($_POST["price"]) && $_POST["price"]!="")){
	$book = $_POST["book"];
	$author = $_POST["author"];
	$price = $_POST["price"];
	if($book){
		$sql = "SELECT book.name AS book, book.price, book.image AS image, author.name AS author 
			FROM book 
			INNER JOIN book_author ON book.id = book_author.book 
			INNER JOIN author ON author.id = book_author.author 
			WHERE book.name LIKE '%$book%'";
	}elseif($author){
		$sql = "SELECT book.name AS book, book.price, book.image AS image, author.name AS author 
			FROM book 
			INNER JOIN book_author ON book.id = book_author.book 
			INNER JOIN author ON author.id = book_author.author 
			WHERE author.name LIKE '%$author%'";
	}elseif($price){
		$sql = "SELECT book.name AS book, book.price, book.image AS image, author.name AS author 
			FROM book 
			INNER JOIN book_author ON book.id = book_author.book 
			INNER JOIN author ON author.id = book_author.author 
			WHERE book.price <= '$price'";
	}/*elseif($book && $author){
		$sql = "SELECT book, author FROM 
		(SELECT book.name AS book, book.price, book.image AS image, author.name AS author 
		FROM book 
		INNER JOIN book_author ON book.id = book_author.book 
		INNER JOIN author ON author.id = book_author.author) as a 
		WHERE a.book LIKE '%book%' AND a.author LIKE '%author%'";
	}elseif($book && $price){
		$sql = "SELECT book.name AS book, book.price, book.image AS image, author.name AS author 
			FROM (SELECT * FROM book WHERE book.name LIKE '%$book%') AS b
			INNER JOIN book_author ON b.id = book_author.book 
			INNER JOIN (SELECT * FROM author WHERE author.name LIKE '%$author%') as a ON a.id = book_author.author";
	}elseif($author && $price){
		$sql = "SELECT book.name AS book, book.price, book.image AS image, author.name AS author 
			FROM book 
			INNER JOIN book_author ON book.id = book_author.book 
			INNER JOIN author ON author.id = book_author.author 
			WHERE (book.price <= '$price' AND author.name LIKE '%$author%')";
	}elseif($book && $author && $price){
		$sql = "SELECT book.name AS book, book.price, book.image AS image, author.name AS author 
			FROM book 
			INNER JOIN book_author ON book.id = book_author.book 
			INNER JOIN author ON author.id = book_author.author 
			WHERE (book.name LIKE '%$book%' AND author.name LIKE '%$author%' AND book.price <= '$price')";
	}*/
}elseif((isset($_POST["book"]) && $_POST["book"]=="") OR (isset($_POST["author"]) && $_POST["author"]=="") OR (isset($_POST["price"]) && $_POST["price"]=="")){
	$message = "Заполните хотя бы одно поле!";
	echo "<script type='text/javascript'>alert('$message');</script>";;
}
	
if(!$sql){
	$sql="SELECT book.name AS book, book.price, book.image AS image, author.name AS author 
		FROM book 
		INNER JOIN book_author ON book.id = book_author.book 
		INNER JOIN author ON author.id = book_author.author";	
}

$result = mysqli_query($db,$sql);
$arr = [];
if($result == false){
	print("Ошибка при выполнении запроса");
}else{
	while($row = mysqli_fetch_array($result)){
		$arr[] = $row;
	}
}
?>
