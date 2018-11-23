<?php
session_start();
	//$_SESSION['cart'] = '';
	if($_GET['func'] == 'add') {
		checkIfExists();
	} else if ($_GET['func'] == 'del') {
		delete();
	} else if ($_GET['func'] == 'empty') {
		leeg();
	} else if ($_GET['func'] == 'show') {
		showCart($_SESSION['cart']);
	} 

	function addToCart() {
		if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
			$items = $_SESSION['cart'];
			$item = array('id' => $_GET['id'], 'aantal' => $_GET['aantal']);
			array_push($items, $item);
			$_SESSION['cart'] = $items;
			header("Location: cart.php?func=show&f=1");
		}else{
			$item = array('id' => $_GET['id'], 'aantal' => $_GET['aantal']);
			$items = array(0 => $item);
			$_SESSION['cart'] = $items;
			header("Location: cart.php?func=show&f=2");
		}
	}

	function checkIfExists() {
		$items = $_SESSION['cart'];
		if (!empty($items)) {
			foreach ($items as $key => $value) {
				if(in_array($_GET['id'], $value)) {
					$items[$key]['aantal'] = $items[$key]['aantal'] += $_GET['aantal'];
					$_SESSION['cart'] = $items;
					header("Location: cart.php?func=show");
				} else {
					addToCart();
					break;
				}
			}
		} else {
			addToCart();
		}
	}

	

	function showCart($items) {
		require "../db/connect.php";
		$totaal = 0;
		?> <table> 
			<tr>
				<th>Naam</th>
				<th>Aantal</th>
				<th>Prijs</th>
			</tr>
			<?php
		if ($_SESSION['cart'] != null) {
			foreach ($items as $key => $value) {
				$stmt = getProduct($value['id']);
				if ($row = $stmt->fetch()) {
					$id = $value['id'];
					$naam = $row['naam'];
					$prijs = $row['prijs'];
					$aantal = $value['aantal'];
					$totaal = ($totaal + $prijs);
				?>	  	

					<tr>
						<td><?php echo $naam; ?></td>
						<td><?php echo $aantal; ?></td>
						<td><?php echo $prijs; ?></td>
						<td><a href="cart.php?func=del&id=<?php echo $key; ?>">Remove</a></td>
					</tr>
					
				<?php 
				}
			} 


			?>
				<tr>
					<td></td>
					<td></td>
					<td><?=$totaal;?></td>
					<td><a href="cart.php?func=empty">Empty</a></td>
				</tr>
				<tr>
					<td><a href="../registratie/login.php">Payment</a></td>
					<td><a href="../overzicht/productpage.php?category=1&pageNumber=0">Continue shopping</a></td>
				</tr>
			<?php
		} else {
			?>
				<tr>
					<td>Your shoppingcart is empty</td>
				</tr>
			<?php
		}
		?> </table> <?php
	}

	function delete(){
		$items = $_SESSION['cart'];
		if(isset($_GET['id'])) {
			unset($items[$_GET['id']]);
		}
		$_SESSION['cart'] = $items;
		header("Location: cart.php?func=show");
	}

	function leeg() {
		$_SESSION['cart'] = null;
		header("Location: cart.php?func=show");
	}
?>