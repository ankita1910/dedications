<?php
session_start();
$output = array("firstName" => 'Rupes', "userId" => 1);
$_SESSION['login_details'] = $output;
?>

<!Doctype html>
<html ng-app = "uploadApp">
<head>
	<!-- https://trinket.io/html/90506676c9 -->
	<title>Dedications</title>
	<link rel="stylesheet" href="../styles/home.css" type="text/css" />
	<link rel="stylesheet" href="../styles/editGiftcard.css" type="text/css" />
	<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Yesteryear' rel='stylesheet' type='text/css'>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="../scripts/editGiftcard.js"></script>
</head>
<body ng-controller = "uploadController">
	<div class="main-container">
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
					if(isset($_SESSION['login_details']['firstName']))
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
		<div class="edit-body-section">
			<div class="trending-showcase">
				<div class="trending-title">
					In case, you want to have a look at trending gift cards in this category!
				</div>
				<div class="showcase-image-container">
					<div class="showcase-image">
						<img src="../contents/showcase-holi.jpg" />
					</div>
					<div class="showcase-image">
						<img src="../contents/showcase-holi.jpg" />
					</div>
					<div class="showcase-image">
						<img src="../contents/showcase-holi.jpg" />
					</div>
					<div class="showcase-image">
						<img src="../contents/showcase-holi.jpg" />
					</div>
					<div class="showcase-image">
						<img src="../contents/showcase-holi.jpg" />
					</div>
				</div>
			</div>
			<div class="edit-sections">
				<div class="edit-left-section">
					<div class="choose-gradient">Choose Background Color for the card
						<div class="color-pallete">
							<div class="colors" ng-repeat = "color in colors" ng-init = "model.bgColor = colors[0]">
								<div class="pallete" ng-click = "model.bgColor = color"style="background-color: {{color}}"></div>
							</div>
						</div>
					</div>
					<div class="receiver-details">
						<div class="receiver-title">
							Receiver Details
						</div>
						<div class="__details">
							<div class="__rname">
								<div class="__text">Name
								</div>
								<div class="__value">
									<input type="text" ng-model = "to">
								</div>
							</div>
							<div class="__remail">
								<div class="__text">Email
								</div>
								<div class="__value">
									<input type="text" ng-model="receiverEmail">
								</div>
							</div>
							<div class="__rphone">
								<div class="__text">Mobile No.
								</div>
								<div class="__value">
									<input type="text">
								</div>
							</div>
						</div>
					</div>
					<div class="giftcard-msg">
						<div class="available-msg">
							<div class="__title">
								Select any message from the list
							</div>
							<div class="__message-list">
								<select name="quotes" id="selectedQuote" ng-model = "selectedQuote" class="quotes">
									<div class="quotes">
										<option class= "quotes" ng-repeat="quoteJson in jsonData.quotes" value="{{quoteJson.quote}}">
											{{quoteJson.quote}}
										</option>
									</div>
								</select>
							</div>
						</div>
						<div class="custom-msg">
							<div class="__title">
								OR Wanna write a customised message?
							</div>
							<div class="__message" >
								<input type="textarea" ng-model = "message">
							</div>
						</div>
					</div>
					<div class="scheduled-date">
						<div class="__title">
							When do you wish to send this card?
						</div>
						<div class="date-holder">
							<input type="date" ng-model = "date"></input>
						</div>
					</div>
				</div>
				<div class="edit-right-section" ng-style = "{'background-color': model.bgColor}">
					<div class="main-title">
						Happy Holi!
					</div>
					<div class="cover-banner">
						<img src="../contents/gift-card-holi.jpg" />
					</div>
					<div class="right-details">
						<div class="receiver-name">
							Hello, {{to}}
						</div>
						<div class="message">
							{{message == null || message == "" ? selectedQuote : message}}
						</div>
						<div class="sender-name" ng-init = 'model.user_id = "<?php echo $_SESSION['login_details']['userId'];?>"'>
							Best Regards, <br /><span class="__name" ng-model="from">
							<?php
							echo $_SESSION['login_details']['firstName']; 
										//echo "{{ }}";
							?>
							
						</span>
						
					</div>
					<div class="bottom-band">
						<div class="sending-memories">
							<div class="__title">
								Sending our sweet memories with this card! :)
							</div>
							<div class="image-tile" id="imagesLoaded">
								<span class="document-image-frame">
									<a href="#" class="upload-document-image">Upload Image</a>
									<input type="file" accept="image/*" style="display:none" width = "100px" height = "100px" onchange="handleFiles(this)" />
								</span>
							</div>
						</div>
					</div>
					<div class="copyrights">
						All rights reserved. @Dedications.Inc
					</div>
					<div class="gift-card-image">
					</div>
				</div>
			</div>
			<div class="send-card">
				<div class="__save" ng-click = "saveGiftcard()">Save card and Edit later 
				</div>
				<div class="__send">Send card on scheduled date
				</div>
			</div>
		</div>
	</div>
	<div class="footer">copyrights 2016 Dedications.Inc
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	$(".__message-list").click(function(){
		if($(".__message-list").hasClass("popup")){
			$(".__message-list").removeClass("popup");
			$(".__list").css("display", "none");
			$(".__list-item").css("border-bottom", "0px");
		}
		else{
			$(".__list").css("display", "block");
			$(".__list-item").css("border-bottom", "1px solid #dfe3e7");
			$(".__message-list").addClass("popup");
		}
	});
</script>