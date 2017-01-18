<?php
		session_start();
?>

<!Doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Dedications</title>
	<link rel="stylesheet" href="../styles/home.css" type="text/css" />
	<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.5.0/slick-theme.css"/>
	<link rel="stylesheet" href="../styles/customSlick.css" type="text/css" />
</head>
<body ng-app = "myApp">
	<div class="main-container" ng-controller = "myController">
		<div class="header">
			<div class="left-section">
				<div class="_dedication-logo">
					DEDICATIONS
				</div>
			</div>
			<div class="right-section">
				<div class="_giftcards-link">
					GIFTCARDS
				</div>
				<div class="login">
					<?php 
						if(isset($_SESSION['login_details']))
						{
							echo '<span>'.$_SESSION['login_details']['firstName'].'</span>'; 
						}
						else
						{
							echo '<a href="login.html">LOGIN</a>';
						}
					?>
				</div>
			</div>
		</div>
		<div class="body-section">
			<div class="trending-showcase slider">
				<img src="../contents/party-showcase.jpg"/>
				<img src="../contents/slick2.jpg" />
				<img src="../contents/slick3.jpg" />
				<img src="../contents/slick4.jpg" />
			</div>
			<div class="gift-card-listing">
				<div class="left-section">
					<div class="filters">
					<div class="filter-heading">FILTER BY
						<span class="clearfilters" ng-click = "clearFilter()">Clear</span>
					</div>
						<ul ng-repeat = "giftcardCategory in jsonData">
							<li>
								<input type="checkbox" ng-click = "setFilter(giftcardCategory.giftcard_cat_name)">
								<span class="__filter-name" style="color: {{giftcardCategory.giftcard_cat_color}}">{{giftcardCategory.giftcard_cat_name}}</span></input>
							</li>
						</ul>
					</div>
				</div>
				<div class="right-section">
					<div class="giftcards">
						<div class="temp-card" ng-repeat = "giftcard in jsonData | filter : categoryName">
							<div class="card-container" id = "{{giftcard.giftcard_id}}" ng-click = "editPage(giftcard.giftcard_id)" style="background-color: {{giftcard.giftcard_cat_color}}">
								<div class="category-details">
									{{giftcard.giftcard_displayname}}
								</div>
								<div class="poster-container">
									<img src="../contents/holi.jpg" />
								</div>
								<div class="details-container">
									<div class="quote">{{giftcard.quote}}</div>
									<div class="customize-card" ng-click = "goToEditPage(cardItem.category, cardItem.sub-category)">
										CUSTOMIZE CARD
									</div>
									<div class="price">Rs. {{giftcard.price}}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="imakecards">
				<div class="_title">
					Didn't find any match! Make a card as you wish!
				</div>
				<div class="_description">
					Make a gift card of your choice and gift your loved ones. Because happiness is  making others happy. 
				</div>
				<div class="make-card-button">
					MAKE MY CARD
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="__text">copyrights 2016 Dedications.Inc</div>
		</div>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="../scripts/slick/slick.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="../scripts/home.js"></script>
</body>
</html>