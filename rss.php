<?PHP
header('Content-Type: application/xml');

$xml = new SimpleXMLElement(file_get_contents('http://feeds.washingtonpost.com/rss/rss_volokh-conspiracy'));

foreach ($xml->channel->item as $item) {
	$item->title = '[' . $item->children('http://purl.org/dc/elements/1.1/')->creator . '] ' . $item->title;
}

echo $xml->asXML();
?>
