<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Шаблоны сайтов</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link rel="stylesheet" type="text/css" href="<?=ROOT?>assests/style.css" media="all">
	</head>
	<body>
		<div class="wrapper">
			<div class="header">
				<div class="headerContent">
					<div class="left"><h1><a href="#">Cherry</a></h1><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p></div>
					<div class="right">
						<form class="search">
							<input type="text" placeholder="Search...">
							<input type="image" src="<?=ROOT?>assests/images/search.png" title="Search">
						</form>
					</div>
				</div>
			</div>
			<div class="slider">
				<div class="itemSlider">
					<div class="bgSlide"><img src="<?=ROOT?>assests/images/bg-slide.jpg"></div>
					<div class="descSlide">
						<h1>Eaten berry</h1>
						<p>and go for a walk</p>
						<span>Duis aute irure dolor...</span>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					</div>
				</div>
			</div>
			<div class="nav">
				<ul class="menu">
					<li><a href="#">Home</a></li>
					<li><a href="#">Sliders</a></li>
					<li><a href="#">Portfolio</a></li>
					<li><a href="#">Styles</a></li>
					<li><a href="#">Blog</a></li>
					<li><a href="#">Cherry</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</div>
			<div class="breadcrumbs"><a href="#">Home</a> / <a href="#">Another Page</a> / This page</div>
			<div class="main">
				<div class="leftCol">
					<form>
						<h2>Contact us</h2>
						<input type="text" placeholder="Lorem ipsum">
						<input type="text" placeholder="Dolor sit">
						<input type="text" disabled="disabled" placeholder="Disabled">
						<input type="text" placeholder="Consectetur">
						<select>
							<option>1</option>
							<option>2</option>
							<option>3</option>
						</select>
						<div class="row">
							<h4>Radio</h4>
							<input type="radio">
							<label>Lorem ipsum dolor sit amet</label>
							<div class="clear"></div>
							<input type="radio">
							<label>Duis aute irure dolor</label>
							<div class="clear"></div>
							<input type="radio">
							<label>Excepteur sint occaecat</label>
							<div class="clear"></div>
						</div>
						<div class="row">
							<h4>Checkbox</h4>
							<input type="checkbox" />
							<label>Duis aute irure dolor</label>
							<div class="clear"></div>
							<input type="checkbox" />
							<label>Excepteur sint occaecat</label>
							<div class="clear"></div>
						</div>
						<button type="submit" class="minWidth">Lorem ipsum</button>
						<button type="reset" class="minWidth">Reset</button>
					</form>
					<div class="row">
						<h2>Headline</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
						<p><a href="#">More about</a></p>
					</div>
				</div>
				<div class="rightCol">
					<?=$content?>
				</div>
			</div>
			<div class="footer">
				<div class="footerContent">
					<div class="span1">
						<h1>Sed ut</h1>
						<div class="borderBottom"></div>
						<p>Lorem ipsum dolor sit</p>
						<ul class="clock">
							<li>Nights! Absolutely No Extra Charge</li>
							<li>Weekends! Absolutely No Extra Charge</li>
							<li>Holidays! Absolutely No Extra Charge</li>
						</ul>
						<div class="social">
							<div>Мы в социальных сетях: </div><ul><li><a target="newtab" href="http://www.facebook.com/?sk=app_2309869772"><img src="<?=ROOT?>assests/images/facebook.png"></a></li><li><a target="newtab" href="https://twitter.com/psdhtmlcss"><img src="<?=ROOT?>assests/images/twitter.png" /></a></li><li><img src="<?=ROOT?>assests/images/vk.png" /></li></ul>
						</div>
					</div>
					<div class="span1">
						<h1>At vero eos</h1>
						<div class="borderBottom"></div>
						<p>Lorem ipsum dolor sit</p>
						<ul>
							<li>West Hollywood (323) 221-1107</li>
							<li>Beverly Hills (310) 202-5428</li>
							<li>Pasadena (626) 296-2664</li>
							<li>West Hollywood (323) 221-1107</li>
							<li>Beverly Hills (310) 202-5428</li>
						</ul>
						<p><strong>Lorem ipsum dolor sit amet</strong></p>
					</div>
					<div class="span1">
						<h1>Lorem ipsum dolor</h1>
						<div class="borderBottom"></div>
						<p>Lorem ipsum dolor sit</p>
						<ul class="unstyled">
							<li>Hi-Tech Cherry Company</li>
							<li><a href="mailto:psdhtmlcss@mail.ru">infocherry@gmail.com</a></li>
							<li>5104 W. Washington Blvd</li>
							<li>Los Angeles , CA , 90016 United States</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>