Use any layout (based on pagetype of children) for your children pages in Children loop. Great for homepage with different children page types. Works fine if your children is redirector page - it will use sublayout of linked page.  

<h3>How to:</h3>
<pre><code>
<% loop Children %>
	<article>
		<h1>$Title</h1>
		$Sublayout
	</article>
<% end_loop %>
</code></pre>

$Sublayout will be generated depending on Children's Pagetype.

<h3>Example </h3>
(showing 3 images from PortfolioPage pagetype). You can make this page as a direct children (PortfolioPage pagetype) or create as RedirectorPage linked to PortfolioPage. $FinalData are data from linked page, $Title is title of RedirectorPage (children). Sublayouts are stored in Sublayout folder and must be prefixed with "sl_".

<pre><code>
theme file: themes/your-theme/Sublayout/sl_PortfolioPage.ss
</code></pre>

<pre><code>
<div class="Sublayout subpageType-$FinalData.ClassName PortfolioPageLayout">

		<section class="ContentFull">
		<h1>$Title</h1>
		<% if FinalData.AllPortfolios.Limit(3) %>
			<% loop FinalData.AllPortfolios.Limit(3) %>
				<section class="columns four<% if MultipleOf(3) %> lastInRow<% end_if %>">
					<div class="gallery_item">$Image.Thumb2
						<h3>
							<strong>$Description</strong>
							<% if BigImageID %><a class="detail" href="$BigImage.Full.Link">Detail</a><% end_if %>
							<% if Link %><a href="$Link">Navštíviť</a><% end_if %>
						</h3>
						<h2>$Title</h2>
					</div>
				</section>
			<% end_loop %>
		<% else %>
			<p>Momentálne bez projektov</p>
		<% end_if %>
		</section>
		
</div>
</code></pre>

