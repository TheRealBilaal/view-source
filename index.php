<?php 
	ini_set("display_errors", "off");

	include "geshi/geshi.php";

	//Performs cURL HTTP request
	function file_get_contents_curl($url) {
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

	    $data = curl_exec($ch);
	    curl_close($ch);

	    return $data;
	}

	//Unminifies HTML - does not work on CSS or JS
	function unminify_html($html) {
		$dom = new DOMDocument();		

		$dom->preserveWhiteSpace = false;
		$dom->loadHTML($html, LIBXML_HTML_NOIMPLIED);
		$dom->formatOutput = true;

		return $dom->saveXML($dom->documentElement);
	}

	//Turns URLs into hyperlinks
	function markup_links($html,$url) {
		preg_match("/https?:\/\/\S+?(?=\/)/i", $url, $matches);

		$baseurl = $matches[0];

		$regex = array("/(?<=&quot;)(https?:\/\/\S+)(?=&quot;)/i",	// Absolute paths: &quot;http://asdf.com/asdf.php?id=x&ad=y&quot;
					   "/(?<=&quot;)(\/\S+)(?=&quot;)/i");			// Relative paths: &quot;/scripts/regex-1.1.min.js&quot;
		
		$replc = array('<a href="$1">$1</a>', '<a href="'.$baseurl.'$1">$1</a>');

		return preg_replace($regex, $replc, $html);
	}

	//Performs syntax highlighting
	function geshi_highlight($code, $lang) {
		$geshi = new GeSHi($code, $lang);
		$geshi->enable_keyword_links(false);
		$geshi->enable_classes();

		return [$geshi->parse_code(), $geshi->get_stylesheet()];
	}

	// //URL to view source for
	$url = $_GET['url'];

	//Defines variables to store output code and styles
	$html = "";
	$stylesheet = "";

	//Retrieves and decodes source code from URL
	$html = file_get_contents_curl($url);
	$html = urldecode($html);

	$html = str_replace('<script', '<script type="text/javascript"', $html);

	//Unminifies HTML
	$html = unminify_html($html);

	//Highlights HTML syntax using GeSHi
	$geshi = geshi_highlight($html, "html5");
	$html = $geshi[0];
	$stylesheet = $geshi[1];

	//Replace tab with spaces
	$html = str_replace("\t", "    ", $html);

	//Trim trailing spaces
	$html = preg_replace("/[ \t]+$/", "", $html);

	//Replace URLs with links
	$html = markup_links($html, $url);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width" />
		<title>Source of <?php echo htmlspecialchars($url); ?></title>
		<style>
			pre {
				overflow: auto;
				white-space: pre-wrap;
				word-wrap: break-word;
			}
			<?php echo $stylesheet; ?>
		</style>
	</head>
	<body>
		<?php echo $html; ?>
	</body>
</html>
