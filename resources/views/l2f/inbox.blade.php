<!--inbox -->
<div data-role="page" id="inbox">
    <div data-role="header">
	<a href="#main"  data-shadow="false"  data-iconshadow="false" class="btn-back-top"  ><span class="ico"></span></a>
	<h1 class="title">Письма</h1>
    </div>
    <div data-role="content" >
	<div id="inbox_content_cols" class="inbox_content_cols inbox-container">

	</div>
	<div class="div-center div-color div-color-none">
	    <button class="letter-icon" onclick='$.mobile.changePage("#main", {transition: "slideup"});'>Написать письмо</button>
	</div>
	<div class="inbox_content"  id="inbox_content">
	</div>


    </div>
</div>