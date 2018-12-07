<?php
require '../main/meta.php';

if(!isset($_GET['func'])){
	} else {
		if($_GET['func'] == 'add') {
			checkIfExists();
		} else if ($_GET['func'] == 'del') {
			delete();
		} else if ($_GET['func'] == 'empty' && $_GET['order'] == 'y') {
			leeg();
			header("Location: ../landing/index.php");
		} else if ($_GET['func'] == 'empty' && $_GET['order'] != 'y') {
			leeg();
		}
	}

	function addToCart() {
		if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
			$items = $_SESSION['cart'];
			$item = array('id' => $_GET['id'], 'aantal' => $_GET['aantal'], 'category' => $_GET['cat']);
			array_push($items, $item);
			$_SESSION['cart'] = $items;
			$_SESSION['cart_item'] = "added";
			header("Location: index.php");
		}else{
			$item = array('id' => $_GET['id'], 'aantal' => $_GET['aantal'], 'category' => $_GET['cat']);
			$items = array(0 => $item);
			$_SESSION['cart'] = $items;
			$_SESSION['cart_item'] = "added";
			header("Location: index.php");
		}
	}

	function checkIfExists() {
		$gevonden = FALSE;
		$items = $_SESSION['cart'];
		// check if empty
		if (!empty($items)) {
			// if not empty
			foreach ($items as $key => $value) {
				// check if item exists
				if($_GET['id'] == $value['id']) {
					// Current item exists
					$gevonden = TRUE;
					break;
				} else  {
					// current item doesn't exist
					$gevonden = FALSE;
				}
			}
			if($gevonden) {
				$items[$key]['aantal'] = $items[$key]['aantal'] += $_GET['aantal'];
				$_SESSION['cart'] = $items;
				header("Location: index.php");			
			} else {
				addToCart();
			}
		} else {
			// if empty
			addToCart();
		}
	}

	function delete(){
		$items = $_SESSION['cart'];
		if(isset($_GET['id'])) {
			unset($items[$_GET['id']]);
		}
		$_SESSION['cart'] = $items;
		$_SESSION['cart_item'] = "remove";
		header("Location: index.php");
	}

	function leeg() {
		$_SESSION['cart'] = null;
		$_SESSION['id'] = null;
		$_SESSION['gast'] = null;
		var_dump($_SESSION);
		echo "empty";
		header("Location: index.php");
	}
?>