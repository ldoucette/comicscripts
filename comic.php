<?php 

/*
 *	Author: Lolita Douccette
 *	Version: 2016.09.23
 *	 
 */
 
 ?>

<!DOCTYPE>
<html>
	<head>
        <title>Comic Page</title>  
            
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  
        <script type="text/javascript">  
        		var page=0;
        		var chapter=0;
        		var status='first';
        		var panel='';
        		var numPanels=0;

				function hideBtn(btn) {
					$(btn).hide();
				}

        		function showBtn(btn) {
					$(btn).show();
            	}

          		function setButtons(status) {
					if (status=='first') {
						hideBtn('.btnPrevious');
						showBtn('.btnNext');
					}
					if (status=='last') {
						hideBtn('.btnNext');
						showBtn('.btnPrevious');
					} 
					if (status=='current' ) {
						showBtn('.btnNext');
						showBtn('.btnPrevious');
					}
				}
        		
    			function loadImage() {
            		$.ajax({
    			        type: "POST",
    			        url: "panels.php",
    			        cache: false,
    			        data: {page:page,
        			           chapter:chapter},
    			        dataType: "html",
    			        async:    false,
    			        
    			        success: function(data) {
   			             	var json = $.parseJSON(data);
   			             	var chapters = json.chapters;
   			             	var html="";
   			             	numPanels=json.numPanels;
       			            panel=json.panel;
       			            status=json.status;
       			            $('#pNo').html(parseInt(page)+1)	
       			            $('#panel').html('<img src="'+panel+'">');
       			            for(i=0;i<chapters.length;i++) {
           			            html+="<button class='btnChapters' value="+i+">"+chapters[i]+"</button>";
       			            }
       			            $("#pNo").html("Chapter is " + eval(parseInt(chapter)+1) + "<br />Images is " + panel  + "<br /> Page no is " +  eval(page+1) + "<br />Number of panels " + eval(numPanels+1));
       			            $("#chapters").html(html);
						},
    			        error: function(data){
    			             var json = $.parseJSON(data);
    			              alert(json.error);
    			        }
    			    });
    			}
            	
        		// main function
        		$(function() {
					loadImage();
					setButtons(status);
					
					$('#chapters').on('click','.btnChapters', function() {  
						status='first';
						page=0;
					    chapter=$(this).val();
					    loadImage();
					});		
					$('.btnLast').click(function() {
						status='last';
						page=numPanels;
						loadImage();
						setButtons(status);
					});
					$('.btnFirst').click(function() {
						status='first';
						page=0;
						loadImage();
						setButtons(status);
					});
                    $('.btnPrevious').click(function()  {
                        page--;   
	                   	loadImage();  
	                   	setButtons(status);
	                });
                    $('.btnNext').click(function()  
                    {  
                        page++;
                    	loadImage();  
                    	setButtons(status);
        			});
        			  
                });  
                                              
        </script>   
    </head>  
      
    <body>
    	<div id="comic">
	    	<div id="chapters"></div>
	    	<div id="pages">
   				<button class="btnFirst" value='first'>First Page</button>
	    		<button class="btnPrevious">Previous</button>
   				<button class="btnNext">Next</button>
   				<button class="btnLast" value="last">Last Page</button>
   			</div> 
   			<div id="pNo">Page no <span>1</span></div>
   	  		<div id="panel"><img src="panels/Chapter 1/2016_katampogi5.jpg"></div>
   	  	</div>
    </body>  
      
    </html>  

