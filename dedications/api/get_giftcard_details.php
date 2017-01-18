<?php
	$app->get('/api/giftcards', function(){
		include('db_connection.php');
		$giftcards_query = "SELECT gd.giftcard_id
								  ,gc.giftcard_cat_name
								  ,gc.giftcard_cat_color
								  ,gd.giftcard_name
								  ,gd.giftcard_displayname
								  ,gd.price
							FROM giftcard_details as gd
							INNER JOIN giftcard_category AS gc
								ON gd.giftcard_cat_id = gc.giftcard_cat_id";

		$giftcards = $con->query($giftcards_query);
		while($row = $giftcards->fetch_assoc())
		{
			$quote_query = "SELECT quote FROM giftcard_quotes WHERE giftcard_id = " .$row['giftcard_id']. " LIMIT 1";
			$quote = $con->query($quote_query);
			
			while($quote_row = $quote->fetch_assoc())
			{
				$row['quote'] =  $quote_row['quote'];
			}

			$image_link_query = "SELECT image_link FROM giftcard_images WHERE giftcard_id = " .$row['giftcard_id']. " LIMIT 1";
			$image_link = $con->query($image_link_query);
			
			while($image_link_row = $image_link->fetch_assoc())
			{
				$row['image'] =  $image_link_row['image_link'];
			}
			$data[] = $row;

		}

		echo json_encode($data, JSON_UNESCAPED_SLASHES);
	});

	$app->get('/api/quotes_images/{giftcard_id}', function($request, $response){
		include('db_connection.php');
		$giftcard_id = $request->getAttribute('giftcard_id');
		$data = array();
		$quotes_query = "SELECT quote_id, quote FROM giftcard_quotes WHERE giftcard_id = $giftcard_id";
		$quotes = $con->query($quotes_query);
		while($quote = $quotes->fetch_assoc())
		{
			$quotesArray[] = $quote;
		}

		$images_query = "SELECT image_id, image_link FROM giftcard_images WHERE giftcard_id = $giftcard_id";
		$images = $con->query($images_query);
		while($image = $images->fetch_assoc())
		{
			$imagesArray[] = $image;
		}

		$data['quotes'] = $quotesArray;
		$data['images'] = $imagesArray;

		echo json_encode($data, JSON_UNESCAPED_SLASHES);

	});

	$app->post('/api/user_giftcards', function($request, $response){
		include('db_connection.php');
		$parsedBody = $request->getParsedBody();
		print_r($parsedBody);
		echo $parsedBody['user_id']. $parsedBody['giftcard_id']. $parsedBody['bgcolor'];
		$stmt = $con->prepare("INSERT INTO user_giftcard (user_id, giftcard_id, bgcolor, quote, image, status,
		receiver_email, receiver_phone, sending_date) 
  		VALUES   (?, ?, ?, ?, ?, ?, ?, ?, ?)");

  		$stmt->bind_param("iisssisss", $parsedBody['user_id'], $parsedBody['giftcard_id'], $parsedBody['bgcolor'],$parsedBody['quote'], $parsedBody['image'], $parsedBody['status'], $parsedBody['receiver_email'], $parsedBody['receiver_phone'], $parsedBody['sending_date']);


	  $stmt->execute();
	  printf("Error: %s.\n", $stmt->error);
	  echo "New records created successfully";
	});
?>