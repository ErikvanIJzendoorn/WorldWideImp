<?php
session_start();
	//$_SESSION['cart'] = '';
	if(!isset($_GET['func'])){

	} else {
		if($_GET['func'] == 'add') {
			checkIfExists();
		} else if ($_GET['func'] == 'del') {
			delete();
		} else if ($_GET['func'] == 'empty') {
			leeg();
		}
	}

	function addToCart() {
		if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
			$items = $_SESSION['cart'];
			$item = array('id' => $_GET['id'], 'aantal' => $_GET['aantal']);
			array_push($items, $item);
			$_SESSION['cart'] = $items;
			header("Location: index.php");
		}else{
			$item = array('id' => $_GET['id'], 'aantal' => $_GET['aantal']);
			$items = array(0 => $item);
			$_SESSION['cart'] = $items;
			header("Location: index.php");
		}
	}

	function checkIfExists() {
		$items = $_SESSION['cart'];
		if (!empty($items)) {
			foreach ($items as $key => $value) {
				if(in_array($_GET['id'], $value)) {
					$items[$key]['aantal'] = $items[$key]['aantal'] += $_GET['aantal'];
					$_SESSION['cart'] = $items;
					header("Location: index.php");
				} else {
					addToCart();
					break;
				}
			}
		} else {
			addToCart();
		}
	}

	function delete(){
		$items = $_SESSION['cart'];
		if(isset($_GET['id'])) {
			unset($items[$_GET['id']]);
		}
		$_SESSION['cart'] = $items;
		header("Location: index.php");
	}

	function leeg() {
		$_SESSION['cart'] = null;
		header("Location: index.php");
	}
?>