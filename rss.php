<?PHP
header('Content-Type: application/xml');

$feed_url = 'http://feeds.washingtonpost.com/rss/rss_volokh-conspiracy';

if (issert($_GET['feed'])) {
	switch (trim($_GET['feed'])) {
		case 'guns':
			$default_url = 'http://feeds.washingtonpost.com/rss/rss_volokh-conspiracy/guns';
			break;
		case 'squirrelattacks':
			$default_url = 'http://feeds.washingtonpost.com/rss/rss_volokh-conspiracy/squirrelattacks';
			break;
		case 'someotherfeed':
			$default_url = 'http://www.rssfeeds.com/someotherfeed';
			break;
	}
}

$xml = new SimpleXMLElement(file_get_contents($feed_url));

foreach ($xml->channel->item as $item) {
	$item->title = '[' . $item->children('http://purl.org/dc/elements/1.1/')->creator . '] ' . $item->title;
}

echo $xml->asXML();
?>
