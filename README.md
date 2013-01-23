Use any layout (based on pagetype of children) for your children pages in Children loop. Great for homepage with different children page types. Works fine if your children is redirector page - it will use sublayout of linked page.  

<h3>How to:</h3>
[code]
&lt;% loop Children %&gt;
	&lt;article&gt;
		&lt;h1&gt;$Title&lt;/h1&gt;
		$Sublayout
	&lt;/article&gt;
&lt;% end_loop %&gt;
[/code]

$Sublayout will be generated depending on Children's Pagetype.

<h3>Example</h3>
(showing 3 images from PortfolioPage pagetype). You can make this page as a direct children (PortfolioPage pagetype) or create as RedirectorPage linked to PortfolioPage. $FinalData are data from linked page, $Title is title of RedirectorPage (children). Sublayouts are stored in Sublayout folder and must be prefixed with &quot;sl_&quot;.

[code]
theme file: themes/your-theme/Sublayout/sl_PortfolioPage.ss
[/code]

[code]
&lt;div class=&quot;Sublayout subpageType-$FinalData.ClassName PortfolioPageLayout&quot;&gt;

		&lt;section class=&quot;ContentFull&quot;&gt;
		&lt;h1&gt;$Title&lt;/h1&gt;
		&lt;% if FinalData.AllPortfolios.Limit(3) %&gt;
			&lt;% loop FinalData.AllPortfolios.Limit(3) %&gt;
				&lt;section class=&quot;columns four&lt;% if MultipleOf(3) %&gt; lastInRow&lt;% end_if %&gt;&quot;&gt;
					&lt;div class=&quot;gallery_item&quot;&gt;$Image.Thumb2
						&lt;h3&gt;
							&lt;strong&gt;$Description&lt;/strong&gt;
							&lt;% if BigImageID %&gt;&lt;a class=&quot;detail&quot; href=&quot;$BigImage.Full.Link&quot;&gt;Detail&lt;/a&gt;&lt;% end_if %&gt;
							&lt;% if Link %&gt;&lt;a href=&quot;$Link&quot;&gt;Navšt&iacute;vi&amp;#357;&lt;/a&gt;&lt;% end_if %&gt;
						&lt;/h3&gt;
						&lt;h2&gt;$Title&lt;/h2&gt;
					&lt;/div&gt;
				&lt;/section&gt;
			&lt;% end_loop %&gt;
		&lt;% else %&gt;
			&lt;p&gt;Moment&aacute;lne bez projektov&lt;/p&gt;
		&lt;% end_if %&gt;
		&lt;/section&gt;
		
&lt;/div&gt;
[/code]

