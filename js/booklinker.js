var convertCount=0;

function showBookLinker(lnk)
{
	isbn=lnk.id.split("*")[1];
	writeBookLinkerDiv(isbn);
	shield_size("book*" + isbn);
	var linkLeftPos = findPosX(lnk);
	var linkTopPos = findPosY(lnk);
	document.getElementById('shield').style.position='absolute';
	document.getElementById('shield').style.filter = 'alpha(opacity=65)';
	document.getElementById('shield').style.display='block';
	document.getElementById('bookLinkerCollection').style.display='block';
	document.getElementById("book*" + isbn).style.position='absolute';
	document.getElementById("book*" + isbn).style.left=getOptimalLeftPos(linkLeftPos, isbn);
	document.getElementById("book*" + isbn).style.top=linkTopPos;
	document.getElementById("book*" + isbn).style.display='block';
}

function bookLinkerConvertLinks()
{
	convertCount=0;
	for (i=0; i < document.links.length; i++)
	{
		if(document.links[i].rel.toLowerCase() != "nobooklinker")
		{
			convertBookLinkerLink(document.links[i]);
			if (convertAmazon)
			{
				convertAmazonLink(document.links[i]);
			}
			if (convertIndieBound)
			{
				convertIndieBoundLink(document.links[i]);
			}
			if (convertWorldCat)
			{
				convertWorldCatLink(document.links[i]);
			}
			if (convertPowells)
			{
				convertPowellsLink(document.links[i]);
			}
			if(convertLibraryThing)
			{
				convertLibraryThingLink(document.links[i]);
			}
			if(convertOpenLibrary)
			{
				convertOpenLibraryLink(document.links[i]);
			}
			if(convertGoodReads)
			{
				convertGoodReadsLink(document.links[i]);
			}
		}
	}
}

function convertBookLinkerLink(lnk)
{
	if(lnk.rel.toLowerCase()=="booklinker")
	{
		isbn=lnk.href;
		if(isbn.indexOf("/")>0)
		{
			isbnArray=isbn.split("/");
			isbn=isbnArray[isbnArray.length-1];
		}
		lnk.id="isbn*" + isbn;
		lnk.href="#isbn*" + isbn;
		lnk.onclick=function(){showBookLinker(this)};
		lnk.rel="";
	}
}

function convertAmazonLink(lnk)
{
	if(lnk.href.toLowerCase().indexOf("www.amazon.com") > 0 && (lnk.href.toLowerCase().indexOf("creativeasin") > 0 | lnk.href.toLowerCase().indexOf("/obidos/") > 0 | lnk.href.toLowerCase().indexOf("/dp/") > 0))
	{
		isbnArray = lnk.href.split("/");
		if(isbnArray[4].toLowerCase()=="dp")
		{
			isbn=isbnArray[5];
		} else if (isbnArray[3].toLowerCase()=="dp" | isbnArray[3].toLowerCase()=="exec") {
			isbn=isbnArray[isbnArray.length-2];
		} else {
			isbn=isbnArray[isbnArray.length-1];
		}
		if(isbn.indexOf("?") > 0)
		{
			isbn=isbn.split("?")[0];
		}
		if(isbn.indexOf("%") > 0)
		{
			isbn=isbn.split("%")[0];
		}
		lnk.href="#isbn*"+isbn;
		lnk.onclick=function(){showBookLinker(this)};
		lnk.id="isbn*"+isbn;
		convertCount++;
	}
}

function convertIndieBoundLink(lnk)
{
	if(lnk.href.toLowerCase().indexOf("indiebound.org") > 0 && (lnk.href.toLowerCase().indexOf("/aff/") > 0 | lnk.href.toLowerCase().indexOf("?aff=") > 0))
	{
		isbnArray = lnk.href.split("/");
		if(isbnArray[3].toLowerCase()=="book")
		{
			isbn = isbnArray[isbnArray.length-1].split("?")[0];
		} else {
			isbn = isbnArray[isbnArray.length-1].split("=")[1];
		}
		lnk.href="#isbn*"+isbn;
		lnk.onclick=function(){showBookLinker(this)};
		lnk.id="isbn*"+isbn;
		convertCount++;
	}
}

function convertWorldCatLink(lnk)
{
	if(lnk.href.toLowerCase().indexOf("worldcat.org") > 0 && lnk.href.toLowerCase().indexOf("search?q=isbn") > 0)
	{
		isbnArray = lnk.href.split("%3A");
		isbn = isbnArray[isbnArray.length-1];
		lnk.href="#isbn*"+isbn;
		lnk.onclick=function(){showBookLinker(this)};
		lnk.id="isbn*"+isbn;
		convertCount++;
	}
}

function convertPowellsLink(lnk)
{
	if(lnk.href.toLowerCase().indexOf("powells.com") > 0 && lnk.href.toLowerCase().indexOf("/partner/") > 0)
	{
		isbnArray = lnk.href.split("/");
		isbn = isbnArray[isbnArray.length-1];
		lnk.href="#isbn*"+isbn;
		lnk.onclick=function(){showBookLinker(this)};
		lnk.id="isbn*"+isbn;
		convertCount++;
	}
}

function convertGoodReadsLink(lnk)
{
	if(lnk.href.toLowerCase().indexOf("goodreads.com") > 0 && lnk.href.toLowerCase().indexOf("/isbn/") > 0)
	{
		isbnArray = lnk.href.split("/");
		isbn = isbnArray[isbnArray.length-1];
		lnk.href="#isbn*"+isbn;
		lnk.onclick=function(){showBookLinker(this)};
		lnk.id="isbn*"+isbn;
		convertCount++;
	}
}

function convertOpenLibraryLink(lnk)
{
	if(lnk.href.toLowerCase().indexOf("openlibrary.org") > 0 && lnk.href.toLowerCase().indexOf("/partner/") > 0)
	{
		isbnArray = lnk.href.split("/");
		isbn = isbnArray[isbnArray.length-1];
		lnk.href="#isbn*"+isbn;
		lnk.onclick=function(){showBookLinker(this)};
		lnk.id="isbn*"+isbn;
		convertCount++;
	}
}

function convertLibraryThingLink(lnk)
{
	if(lnk.href.toLowerCase().indexOf("librarything.com") > 0 && lnk.href.toLowerCase().indexOf("/OL7361459M/") > 0)
	{
		isbnArray = lnk.href.split("/");
		isbn = isbnArray[isbnArray.length-1];
		lnk.href="#isbn*"+isbn;
		lnk.onclick=function(){showBookLinker(this)};
		lnk.id="isbn*"+isbn;
		convertCount++;
	}
}

function writeBookLinkerDiv(isbn)
{
	addShield();
	var bookLinkerDiv = document.getElementById("book*" + isbn);
	if(bookLinkerDiv == null)
	{
		var bookLinkerDiv = document.createElement("div");
		var bookLinkerCollection = document.getElementById("bookLinkerCollection");
		bookLinkerCollection.appendChild(bookLinkerDiv);
		bookLinkerDiv.id="book*" + isbn;
		bookLinkerDiv.className="bookLinkerDiv";
		var closeLinkP = document.createElement("p");
		closeLinkP.className="bookLinkerCloseLinkParagraph";
		var closeLink = document.createElement("a");
		closeLink.href="#isbn*" + isbn;
		closeLink.id="close*" + isbn;
		closeLink.className="bookLinkerCloseLink";
		closeLink.onclick=function(){closeBookLinkerDiv(this)};
		var closeLinkText = document.createTextNode("Close");
		closeLink.appendChild(closeLinkText);
		closeLinkP.appendChild(closeLink);
		bookLinkerDiv.appendChild(closeLinkP);
		if(showBookCover)
		{
			var bookLinkerImage = document.createElement("img");
			if(libraryThingDevKey)
			{
				bookLinkerImage.src= "http://covers.librarything.com/devkey/" + libraryThingDevKey + "/medium/isbn/" + isbn;
			} else {
				bookLinkerImage.src=imagePath + "/nocover.gif";
			}
			bookLinkerImage.className="bookLinkerImage";
			bookLinkerImage.id="img*" + isbn;
			bookLinkerImage.onload = function(){bookLinkerImageWidth(this)};
			bookLinkerDiv.appendChild(bookLinkerImage);
		}
		bookLinkerTitle=document.createElement("div");
		bookLinkerTitle.className="bookLinkerTitle";
		bookLinkerTitle.id="title*" + isbn;
		bookLinkerDiv.appendChild(bookLinkerTitle);
		bookLinkerAuthor=document.createElement("div");
		bookLinkerAuthor.className="bookLinkerAuthor";
		bookLinkerAuthor.id="author*" + isbn;
		bookLinkerDiv.appendChild(bookLinkerAuthor);
		bookLinkerThumb=document.createElement("div");
		bookLinkerThumb.id="thumbnail*" + isbn;
		bookLinkerDiv.appendChild(bookLinkerThumb);
		var bookLinkerScript = document.createElement("script");
		bookLinkerScript.src="http://openlibrary.org/api/books?bibkeys=ISBN:" + isbn + "&details=true&callback=getOpenLibraryData";
		bookLinkerDiv.appendChild(bookLinkerScript);
		var bookLinkList = document.createElement("ul");
		bookLinkList.className="bookLinkerList";
		bookLinkerDiv.appendChild(bookLinkList);
		if(includeIndieBoundLink)
		{
			var bookLinkItem = document.createElement("li");
			var bookLinkURL = document.createElement("a");
			bookLinkURL.href="http://www.indiebound.org/aff/" + indieBoundAffiliateId + "?product=" + isbn;
			bookLinkURL.title="Buy from an Independent Book Store";
			bookLinkURL.target="blank";
			bookLinkURL.className="bookLinkerLink";
			var bookLinkImage = document.createElement("img");
			bookLinkImage.src = imagePath + "/indiebound.jpg";
			bookLinkImage.alt="Buy from an Independent Book Store";
			bookLinkImage.height=50;
			bookLinkImage.width=50;
			bookLinkURL.appendChild(bookLinkImage);
			bookLinkItem.appendChild(bookLinkURL);
			bookLinkList.appendChild(bookLinkItem);
		}
		if(includeAmazonLink)
		{
			var bookLinkItem = document.createElement("li");
			var bookLinkURL = document.createElement("a");
			bookLinkURL.href="http://www.amazon.com/exec/obidos/ASIN/" + isbn + "/" + amazonAffiliateId;
			bookLinkURL.title="Buy from Amazon.com";
			bookLinkURL.target="blank";
			bookLinkURL.className="bookLinkerLink";
			var bookLinkImage = document.createElement("img");
			bookLinkImage.src = imagePath + "/amazon.gif";
			bookLinkImage.alt="Buy from Amazon.com";
			bookLinkImage.height=50;
			bookLinkImage.width=50;
			bookLinkURL.appendChild(bookLinkImage);
			bookLinkItem.appendChild(bookLinkURL);
			bookLinkList.appendChild(bookLinkItem);
		}
		if(includePowellsLink)
		{
			var bookLinkItem = document.createElement("li");
			var bookLinkURL = document.createElement("a");
			bookLinkURL.href="http://www.powells.com/partner/" + powellsAffiliateId + "/biblio/" + isbn;
			bookLinkURL.title="Buy from Powells.com";
			bookLinkURL.target="blank";
			bookLinkURL.className="bookLinkerLink";
			var bookLinkImage = document.createElement("img");
			bookLinkImage.src = imagePath + "/powells.gif";
			bookLinkImage.alt="Buy from Powells.com";
			bookLinkImage.height=50;
			bookLinkImage.width=50;
			bookLinkURL.appendChild(bookLinkImage);
			bookLinkItem.appendChild(bookLinkURL);
			bookLinkList.appendChild(bookLinkItem);
		}
		if(includeWorldCatLink)
		{
			var bookLinkItem = document.createElement("li");
			var bookLinkURL = document.createElement("a");
			bookLinkURL.href="http://www.worldcat.org/search?q=isbn%3A" + isbn;
			bookLinkURL.title="Find at a Library";
			bookLinkURL.target="blank";
			bookLinkURL.className="bookLinkerLink";
			var bookLinkImage = document.createElement("img");
			bookLinkImage.id="img*" + isbn;
			bookLinkImage.src = imagePath + "/worldcat.gif";
			bookLinkImage.alt="Find at a Library";
			bookLinkImage.height=50;
			bookLinkImage.width=50;
			bookLinkURL.appendChild(bookLinkImage);
			bookLinkItem.appendChild(bookLinkURL);
			bookLinkList.appendChild(bookLinkItem);
		}
		if(includeLibraryThingLink)
		{
			var bookLinkItem = document.createElement("li");
			var bookLinkURL = document.createElement("a");
			bookLinkURL.href="http://www.librarything.com/isbn/" + isbn;
			bookLinkURL.title="Find on LibraryThing";
			bookLinkURL.target="blank";
			bookLinkURL.className="bookLinkerLink";
			var bookLinkImage = document.createElement("img");
			bookLinkImage.src = imagePath + "/librarything.gif";
			bookLinkImage.alt="Find on LibraryThing";
			bookLinkImage.height=50;
			bookLinkImage.width=50;
			bookLinkURL.appendChild(bookLinkImage);
			bookLinkItem.appendChild(bookLinkURL);
			bookLinkList.appendChild(bookLinkItem);
		}
		if(includeOpenLibraryLink)
		{
			var bookLinkItem = document.createElement("li");
			var bookLinkURL = document.createElement("a");
			bookLinkURL.href="http://openlibrary.org/search?q=" + isbn;
			bookLinkURL.title="Find on Open Library";
			bookLinkURL.target="blank";
			bookLinkURL.className="bookLinkerLink";
			var bookLinkImage = document.createElement("img");
			bookLinkImage.src = imagePath + "/openlibrary.jpg";
			bookLinkImage.alt="Find on Open Library";
			bookLinkImage.height=50;
			bookLinkImage.width=50;
			bookLinkURL.appendChild(bookLinkImage);
			bookLinkItem.appendChild(bookLinkURL);
			bookLinkList.appendChild(bookLinkItem);
		}
		if(includeGoodReadsLink)
		{
			var bookLinkItem = document.createElement("li");
			var bookLinkURL = document.createElement("a");
			bookLinkURL.href="http://www.goodreads.com/book/isbn/" + isbn;
			bookLinkURL.title="Find on GoodReads";
			bookLinkURL.target="blank";
			bookLinkURL.className="bookLinkerLink";
			var bookLinkImage = document.createElement("img");
			bookLinkImage.src = imagePath + "/goodreads.gif";
			bookLinkImage.alt="Find on GoodReads";
			bookLinkImage.height=50;
			bookLinkImage.width=50;
			bookLinkURL.appendChild(bookLinkImage);
			bookLinkItem.appendChild(bookLinkURL);
			bookLinkList.appendChild(bookLinkItem);
		}
		if(includePluginLinkBack)
		{
			var bookLinkLinkBackP=document.createElement("p");
			var bookLinkLinkBackURL=document.createElement("a");
			bookLinkLinkBackURL.href="http://borrowedcode.com/?page_id=120";
			bookLinkLinkBackURL.title="BookLinker";
			bookLinkLinkBackURL.target="black";
			bookLinkLinkBackText=document.createTextNode("Links provided by BookLinker");
			bookLinkLinkBackURL.appendChild(bookLinkLinkBackText);
			bookLinkLinkBackP.appendChild(bookLinkLinkBackURL);
			bookLinkerDiv.appendChild(bookLinkLinkBackP);
		}
	}
}
	
function closeBookLinkerDiv(obj)
{
	isbn = obj.id.split("*")[1];
	div = document.getElementById("book*" + isbn);
	div.style.display='none';
	document.getElementById('shield').style.display='none';
	document.getElementById('shield').style.position='relative';
	document.getElementById('bookLinkerCollection').style.display='none';
	document.getElementById("book*" + isbn).style.position='relative';
}
	
function addShield()
{
/*	var shield = document.getElementById("shield");
	if(shield == null)
	{
		shield = document.createElement("div");
		shield.id="shield";
		document.childNodes[0].childNodes[1].appendChild(shield);
	}
*/
}
	
function shield_size(popUpDivVar) {
	if (typeof window.innerWidth != 'undefined') {
		viewportheight = window.innerHeight;
	} else {
		viewportheight = document.documentElement.clientHeight;
	}
	if ((viewportheight > document.body.parentNode.scrollHeight) && (viewportheight > document.body.parentNode.clientHeight)) {
		shield_height = viewportheight;
	} else {
		if (document.body.parentNode.clientHeight > document.body.parentNode.scrollHeight) {
			shield_height = document.body.parentNode.clientHeight;
		} else {
			shield_height = document.body.parentNode.scrollHeight;
		}
	}
	var shield = document.getElementById('shield');
	shield.style.height = shield_height + 'px';
	var popUpDiv = document.getElementById(popUpDivVar);
	popUpDiv_height=shield_height/2-150;//150 is half popup's height
	popUpDiv.style.top = popUpDiv_height + 'px';
}

function window_pos(popUpDivVar) {
	if (typeof window.innerWidth != 'undefined') {
		viewportwidth = window.innerHeight;
	} else {
		viewportwidth = document.documentElement.clientHeight;
	}
	if ((viewportwidth > document.body.parentNode.scrollWidth) && (viewportwidth > document.body.parentNode.clientWidth)) {
		window_width = viewportwidth;
	} else {
		if (document.body.parentNode.clientWidth > document.body.parentNode.scrollWidth) {
			window_width = document.body.parentNode.clientWidth;
		} else {
			window_width = document.body.parentNode.scrollWidth;
		}
	}
	var popUpDiv = document.getElementById(popUpDivVar);
	//window_width=window_width/2-150;//150 is half popup's width
	//popUpDiv.style.left = window_width + 'px';
}
function popup(windowname) {
	shield_size(windowname);
	window_pos(windowname);
	toggle('shield');
	toggle(windowname);		
}

function toggle(div_id) {
	var el = document.getElementById(div_id);
	if ( el.style.display == 'none' ) {	el.style.display = 'block';}
	else {el.style.display = 'none';}
	//alert(el.id + "=" + el.style.display);
}

  function findPosX(obj)
  {
    var curleft = 0;
    if(obj.offsetParent)
        while(1) 
        {
          curleft += obj.offsetLeft;
          if(!obj.offsetParent)
            break;
          obj = obj.offsetParent;
        }
    else if(obj.x)
        curleft += obj.x;
    return curleft;
  }

  function findPosY(obj)
  {
    var curtop = 0;
    if(obj.offsetParent)
        while(1)
        {
          curtop += obj.offsetTop;
          if(!obj.offsetParent)
            break;
          obj = obj.offsetParent;
        }
    else if(obj.y)
        curtop += obj.y;
    return curtop;
  }
  
  function loadBookLinkerNoCover(img)
  {
	img.src=imagePath + "/nocover.gif";
	return true;
  }
  
  function getOptimalLeftPos(linkLeftPos, isbn)
  {
	var optimalPos = linkLeftPos;
	var optimizeDiv = document.getElementById("book*" + isbn);
	var divWidth = 580;
	/*
	if (window.getComputedStyle(optimizeDiv,"").getPropertyValue("width"))
	{
		alert("get width from computed style");
		divWidth = window.getComputedStyle(optimizeDiv,"").getPropertyValue("width");
	}
	if(divWidth.indexOf("px") > 0)
	{
		divWidth = divWidth.substr(0, divWidth.indexOf("px"));
	}
	divWidth = parseInt(divWidth);
	*/
	var screenWidth = document.body.clientWidth;
	if(divWidth + linkLeftPos > screenWidth)
	{
		optimalPos = screenWidth - divWidth - (divWidth * 0.10);
	}
	if(optimalPos < 0)
	{
		optimalPos = 0;
	}
	return optimalPos;
  }
  
  function bookLinkerImageWidth(img)
  {
	var imageWidth=img.width;
	if(imageWidth <= 1)
	{
		loadBookLinkerAlternateImage(img);
//		loadBookLinkerNoCover(img);
	}
	}
	
	function loadBookLinkerAlternateImage(img)
	{
		var replaced=false;
		isbn=img.id.split("*")[1];
		thumbnailDiv=document.getElementById("thumbnail*" + isbn);
		if(thumbnailDiv)
		{
			thumbnailURL=thumbnailDiv.innerHTML;
			if(thumbnailURL)
			{
				img.src=thumbnailURL;
				replaced=true;
			}
		}
		if(!replaced)
		{
			loadBookLinkerNoCover(img);
		}
	}

	function getOpenLibraryData(response)
	{
		try {
		for(property in response)
		{	
			var bookData = response[property];
			if(bookData)
			{
				var bookISBN=bookData["bib_key"].split(":")[1];
				var bookDetails=bookData["details"];
				var thumbnailURL=bookData["thumbnail_url"];
				if(bookDetails)
				{
					var bookTitle = bookDetails["title"];
					var bookAuthor = bookDetails["by_statement"];
					if(bookTitle)
					{
						titleElement=document.getElementById("title*" + bookISBN);
						titleElement.innerHTML=bookTitle;
					}
					if(bookAuthor)
					{
						if(bookAuthor.substr(bookAuthor.length-1,1)==".")
						{
							bookAuthor=bookAuthor.substr(0, bookAuthor.length-1);
						}
						authorElement=document.getElementById("author*" + bookISBN);
						authorElement.innerHTML=bookAuthor;
					}
					if(thumbnailURL)
					{
						thumbnailElement=document.getElementById("thumbnail*" + isbn);
						thumbnailElement.innherHTML=thumbnailURL;
						var bookImage=document.getElementById("img*" + isbn);
						if(bookImage.src.indexOf("nocover.gif")>0)
						{
							bookImage.src=thumbnailURL;
							bookImage.width=95;
						}
					}
				}
			}
		}
		} catch(exception)
		{
			//alert(exception);
		}
		
	}
	