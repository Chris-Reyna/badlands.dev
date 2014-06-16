<?
$addressbook = [];

$filename = "addressbook.csv";

function openFile($filename) {
    $content=[];
    $handle = fopen($filename, "r");
    while(($data = fgetcsv($handle)) !== FALSE){
    	$content[] = $data;
    }
    fclose($handle);
    return $content;
}

function writeCSV($filename, $arrays){
	$handle = fopen($filename, 'w');

	var_dump($handle);

	foreach ($arrays as $array) {
		fputcsv($handle, $array);
	}
	fclose($handle);
}

if (file_exists($filename)){
	$addressbook = openFile($filename);
}else{
	$addressbook = [];
}

$error = "<script> alert('Please fill out required fields')</script>";

if (!empty($_POST)) {

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$relationship = $_POST['relationship'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$zip = $_POST['zip'];
	$phone = $_POST['phone'];
	$entry = [$firstname, $lastname, $relationship, $email, $address, $zip, $phone];


	if (empty($firstname) || empty($lastname) || empty($relationship)|| empty($email) || empty($address) || empty($zip)|| empty($zip)){
		echo $error;
	}else {
		array_push($addressbook, $entry);
		writeCSV($filename,$addressbook);
	}

}

if (isset($_GET['remove'])) {
    $info = $_GET['remove'];
    unset($addressbook[$info]);
    writeCSV($filename, $addressbook);
    exit;
    header("Location: address_book.php");
    
}
?>
<html>
<head>
	<title>Addressbook</title>
</head>
<body>
	<h1>CONTACTS</h1>
	<table border="2" style="width:500px">
		<tr>
			<th>FIRST NAME</th>
			<th>LAST NAME</th>
			<th>RELATIONSHIP</th>
			<th>EMAIL</th>
			<th>ADDRESS</th>
			<th>ZIPCODE</th>
			<th>PHONE#</th>
		</tr>
		<? foreach ($addressbook as $key => $entry) { ?> 
			<tr>
				<? foreach ($entry as $item) { ?>
					<td>
						<?= htmlspecialchars(strip_tags($item)); ?> 
					</td>		
				<? } ?> <td><a href= "?remove=<?= $key?>">Delete Contact</a></td>
			</tr> 
		<? } ?> 			 
	</table>
	
    <form method="POST" enctype="multipart/form-data" action="address_book.php">
        <div class="row">
            <div class="col-md-6">
                <h3>Why sign up with St. Ann's before registering in Sportspilot?</h3>
                <p class= "text-left">By signing up with the Parish program, this allows a board member to contact you and ask any questions you may have about CYO and/or a specific team before registering on the Sportspilot website. This will also make it easier for board members to contact you throughout the season and in between individual seasons.</p>
            </div>
            <div class="col-md-6">
                <div>
                    <label>First Name</label>
                    <div><input type="text" name="firstname" class="span3"></div>
                    
                </div>
                <div>
                    <label>Last Name</label>
                    <div><input type="text" name="lastname" class="span3"></div>
                </div>
                <div>
                    <label>Relationship to Player(s)</label>
                    <div><input type="text" name="relationship" class="span3"></div>
                </div>
                <div>
                    <label>Email </label>
                    <div><input type="email" name="email" class="span3"></div>
                </div>
                <div>
                    <label>Address</label>
                    <div><input type="text" name="address" class="span3"></div>
                </div>
                <div>
                    <label>Zipcode</label>
                    <div><input type="text" name="zip" class="span3"></div>
                </div>
                <div>
                    <label>Phone Number </label>
                    <div><input type="text" name="phone" class ="span3"></div>
                </div>
                <br>
                <div class = "container">
                    <div>
                        <input type="submit" value="Sign up" class="btn btn-primary ">  
                    </div>
                </div>
            </div>
            <br>
        </div>
    </form>

</body>
</html>