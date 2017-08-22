var page=0;
var chapter=0;

var comicData=loadData(chapter);
refreshComic();

var buttons=$('button');
buttons.click(function() {
  var noPages=comicData.pages.length;
  switch (this.id) {
    case "firstButton":
      page=0;
      break;
    case "previousButton":
      page--;
      if (page<0)
        page=0;
      break;
    case "nextButton":
      page++;
      if (page>noPages)
        page=noPages;
      break;
    case "lastButton":
      page=noPages-1;
      break;
    }
    loadPage(page);
});

$('#chapters').on('click','.btnChapters', function() {
    chapter=eval($(this).val());
    //alert(chapter);
    page=0;
    comicData=loadData(chapter);
    refreshComic();
});

$('#pNo').on('click','.btnPage', function() {
    page=eval($(this).val());
    //alert(page);
    loadPage(page);
});

function loadData (chapter) {
    console.log(page + " " + chapter);
    var comic={};
    $.ajax({
      type: "POST",
      url: "./panels.php",
      cache: false,
      data: {"chapterNo":chapter},
      dataType: "json",
      async:    false,

      success: function(data) {
          //alert("loadData " + JSON.stringify(data));
          comic.chapter=data.chapter;
          comic.chapters = data.chapters;
          comic.pages=data.pages;
      }
    });
    return comic;
  };

function loadChapters(chapters) {
  var line;
  $('#chapters').html("");
  for(var i=0; i<chapters.length; i++){
    line="<button class='btnChapters' value="+i+">"+chapters[i]+"</button>";
    $('#chapters').append(line);
  }
}

function loadPages(chapter,pages) {
  var line;
  $('#pNo').html("");
  if (pages==null) {
    return;
  }
  for(var i=0; i<pages.length; i++){
    line="<button class='btnPage' value="+i+">"+(i+1)+"</button>";
    $('#pNo').append(line);
  }
}

function loadPage(page) {
  /*
  $('#panel').html("");
  $('#panel img').remove();
  console.log('#panel');
  $('<img src="'+ comicData.pages[page] +'">').on('load',function() {
    $(this).appendTo('#panel');
  });
  */
  if (comicData.pages!=null) {
    var line='<img src="'+ comicData.pages[page] +'">';
    $('#panel').html(line);
  } else {
    $('#panel').html("No panel or image");
  }
}

function loadChapter(chapter) {
  var line="<span>" + chapter + "</span>";
  $('#chapter').html("");
  $('#chapter').append(line);
}

function refreshComic() {
  //alert(comicData.chapter);
  //alert(comicData.chapters);
  //alert("refreshComic " + comicData.pages);
  loadChapters(comicData.chapters);
  loadPages(comicData.chapter, comicData.pages);
  loadChapter(comicData.chapter);
  loadPage(page);
}
