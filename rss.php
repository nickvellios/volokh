<?PHP
header('Content-Type: application/xml');

$feed = file_get_contents('http://feeds.washingtonpost.com/rss/rss_volokh-conspiracy');
$xml = new SimpleXMLElement($feed);

foreach ($xml->channel->item as $item) {
	$dc = $item->children('http://purl.org/dc/elements/1.1/');
	$creator = $dc->creator;
	$item->title = '[' . $creator . '] ' . $item->title;
}

echo $xml->asXML();
?>
