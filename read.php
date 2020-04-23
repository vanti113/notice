<?php
print <<<_html_

<!doctype html>
	

	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Document</title>
	</head>

	<body>
		<div class="title" style="padding: 5%;" align="center">
			<p>$v[title]</p>
			<hr />
		</div>
		<br />
		<div class="text" align="center">
			<pre style="padding-right: 10%;">
				$v[comments]
			</pre>
		</div>
	</body>

	</html>
_html_;
