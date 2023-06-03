<?php
	//Using Kirby's HEADER Class to send the XML document header
	Header::contentType("Content-type: text/xml");
	$kirby->response()->type('text/xml');
	
	//Check if a specific feed was declared in the URL
	if(isset($_GET['feed'])) {
		$feed = $_GET['feed'];
	}else{
		//If no specific feed was declared, use the default "blogposts"
		$feed = "blogposts";
	}
	
	//The feed declared in the URL must exist as a Kirby collection
	$items = $kirby->collection($feed);
	
	//---Return XML file that is built once or create XML on the fly---
	//A: Build a DOM tree for the RSS feed -> Echo it
	//B: Check if XML file exists and is more recent than most recent post. Generate file if it is old.
	
	//Blog is not getting many views yet, using A for now.
	
	$rss = new DOMDocument();
	
	$rss->encoding = 'utf-8';
	$rss->xmlVersion = '1.0';
	$rss->formatOutput = false;
	
	$rootNode = $rss->createElement('rss');
	$rootNodeVersionAttribute = new DOMAttr('version', "2.0");
	$rootNode->setAttributeNode($rootNodeVersionAttribute);
	$rootNodeNamespaceAttribute = new DOMAttr('xmlns:atom', "http://www.w3.org/2005/Atom");
	$rootNode->setAttributeNode($rootNodeNamespaceAttribute);
	
	$channelNode = $rss->createElement('channel');
	
	$channelAtomLinkNode = $rss->createElement('atom:link');
	$channelAtomLinkNodeHref = new DOMAttr('href', "https://beachball.tech/feed");
	$channelAtomLinkNodeRel = new DOMAttr('rel', "self");
	$channelAtomLinkNodeType = new DOMAttr('type', "application/rss+xml");
	$channelAtomLinkNode->setAttributeNode($channelAtomLinkNodeHref);
	$channelAtomLinkNode->setAttributeNode($channelAtomLinkNodeRel);
	$channelAtomLinkNode->setAttributeNode($channelAtomLinkNodeType);
	$channelNode->appendChild($channelAtomLinkNode);
	
	$channelTitleNode = $rss->createElement('title', $site->title());
	$channelNode->appendChild($channelTitleNode);
	
	$channelLinkNode = $rss->createElement('link', $site->URL());
	$channelNode->appendChild($channelLinkNode);
	
	$channelDescriptionNode = $rss->createElement('description', $site->description());
	$channelNode->appendChild($channelDescriptionNode);
	
	$channelLanguageNode = $rss->createElement('language', "en-us");
	$channelNode->appendChild($channelLanguageNode);
	
	$channelPubdateNode = $rss->createElement('pubDate', $kirby->page($items->first())->date()->toDate('r')); //Fake pubDate of this on-the-fly generated RSS feed to be date of most recent post
	$channelNode->appendChild($channelPubdateNode);
	
	$channelLastBuildDateNode = $rss->createElement('lastBuildDate', $kirby->page($items->first())->date()->toDate('r')); //Fake pubDate of this on-the-fly generated RSS feed to be date of most recent post
	$channelNode->appendChild($channelLastBuildDateNode);
	
	$channelDocsNode = $rss->createElement('docs', "https://validator.w3.org/feed/docs/rss2.html"); //A URL that points to the documentation for the format used in the RSS file. It's probably a pointer to this page. It's for people who might stumble across an RSS file on a Web server 25 years from now and wonder what it is.
	$channelNode->appendChild($channelDocsNode);
	
	$channelGeneratorNode = $rss->createElement('generator', "Beachball.tech custom theme with RSS generation capabilities: https://github.com/stairjoke/beachball-tech/blob/main/site/templates/feed.php");
	$channelNode->appendChild($channelGeneratorNode);
	
	$channelManagingEditorNode = $rss->createElement('managingEditor', "hello@beachball.tech (Wenzel Massag)");
	$channelNode->appendChild($channelManagingEditorNode);
	
	$channelWebMasterNode = $rss->createElement('webMaster', "hello@beachball.tech (Wenzel Massag)");
	$channelNode->appendChild($channelWebMasterNode);
	
	foreach($items as $item) {
		$itemNode = $rss->createElement('item');
		$currentPage = $kirby->page($item);
		
		$itemTitleNode = $rss->createElement('title', $currentPage->title());
		$itemNode->appendChild($itemTitleNode);
		
		$itemLinkNode = $rss->createElement('link', $currentPage->url());
		$itemNode->appendChild($itemLinkNode);
		
		$itemGUIDNode = $rss->createElement('guid', $currentPage->url());
		$itemNode->appendChild($itemGUIDNode);
		
		$itemDescription = htmlspecialchars($currentPage->teaser()->kirbytext()) . "<p><a href='". $currentPage->url() ."'>Continue reading…</a></p>";
		$itemDescriptionNode = $rss->createElement('description', $itemDescription);
		$itemNode->appendChild($itemDescriptionNode);
		
		$itemPubDate = $rss->createElement('pubDate', $currentPage->date()->toDate('r'));
		$itemNode->appendChild($itemPubDate);
		
		$channelNode->appendChild($itemNode);
	}
	
	$rootNode->appendChild($channelNode);
	$rss->appendChild($rootNode);
	echo $rss->saveXML();
?>