<?PHP
header('Content-Type: application/xml');

// Default feed
$feed_url = 'http://feeds.washingtonpost.com/rss/rss_volokh-conspiracy';

if (isset($_GET['feed'])) {
	switch (trim($_GET['feed'])) {
		case 'guns': // If '?feed=guns' is appended to the URL, this will be the feed used
			$feed_url = 'http://feeds.washingtonpost.com/rss/rss_volokh-conspiracy/guns';
			break;
		case 'squirrelattacks': // If '?feed=squirrelattacks' is appended to the URL, this will be the feed used
			$feed_url = 'http://feeds.washingtonpost.com/rss/rss_volokh-conspiracy/squirrelattacks';
			break;
		case 'someotherfeed': // If '?feed=someotherfeed' is appended to the URL, this will be the feed used
			$feed_url = 'http://www.rssfeeds.com/someotherfeed';
			break;
	}
}

$xml = new SimpleXMLElement(file_get_contents($feed_url));

foreach ($xml->channel->item as $item) {
	$item->title = '[' . $item->children('http://purl.org/dc/elements/1.1/')->creator . '] ' . $item->title;
}

echo $xml->asXML();
?>
