<?
if($_SERVER['REQUEST_METHOD']=='GET'){
if((isset($_GET["book"]) && !empty($_GET["book"])) OR (isset($_GET["author"]) && !empty($_GET["author"])) OR (isset($_GET["price"]) && !empty($_GET["price"]))){
	$book = $_GET["book"];
	$author = $_GET["author"];
	$price = $_GET["price"];
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
	}
}elseif((isset($_GET["book"]) && $_GET["book"]=="") OR (isset($_GET["author"]) && $_GET["author"]=="") OR (isset($_GET["price"]) && $_GET["price"]=="")){
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
}
?>
