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
			header("Location: index.php");
		}else{
			$item = array('id' => $_GET['id'], 'aantal' => $_GET['aantal'], 'category' => $_GET['cat']);
			$items = array(0 => $item);
			$_SESSION['cart'] = $items;
			header("Location: index.php");
		}
	}

	function checkIfExists() {
		$gevonden = FALSE;
		$items = $_SESSION['cart'];
		var_dump($items);
		// check if empty
		if (!empty($items)) {
			// if not empty
			foreach ($items as $key => $value) {
				// check if item exists
				if($_GET['id'] == $value['id']) {
					// Current item exists
					echo 'found it <br>';
					$gevonden = TRUE;
					break;
				} else  {
					// current item doesn't exist
					echo "this isn't it <br>";
					$gevonden = FALSE;
				}
			}

			if($gevonden) {
				echo "It was found, now change it <br>";
				$items[$key]['aantal'] = $items[$key]['aantal'] += $_GET['aantal'];
				$_SESSION['cart'] = $items;
				echo "1";
				header("Location: index.php");
							
			} else {
				echo "it wasn't found, now add it <br>";
				addToCart();
			}


		} else {
			// if empty
			echo "4";
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
		$_SESSION['id'] = null;
		$_SESSION['gast'] = null;
		var_dump($_SESSION);
		echo "empty";
		header("Location: index.php");
	}
?>