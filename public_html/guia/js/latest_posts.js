$(document).ready(function () {
      var lastsPosts = "http://sphellar.com/mx/api/get_recent_posts/?count=3&read_more=More&callback=?";
      $.getJSON(lastsPosts, {
            format: "json"
      }).done(function (data) {            
            $.each(data.posts, function (i, post) {
                  articulo = "<li class='slide'";
                  articulo += "<div class = 'imgwrap' >";
                  articulo += "<a href = '" + post['url'] + "' title = '" + post['title'] + "'>";
                  articulo += "<img src = '" + post['thumbnail_images']['journal']['url'] + "' class = 'tranz wp-post-image' alt = '" + post['title'] + "' / >";
                  articulo += "</a>";
                  articulo += "<p class='meta'>";
                  articulo += "<i class='icon-clock'></i>" + post['date'] + "<span class='views'></span>";
                  articulo += "</p>";
                  articulo += "</div>";
                  articulo += "<div class = 'clearfix'></div>";
                  articulo += "<div class = 'blockinside'>";
                  articulo += "<h2><a href = '" + post['url'] + "' title = '" + post['title'] + "'>" + post['title'] + "</a></h2>";
                  articulo += "<p class = 'teaser'></p>";
                  articulo += "<p class = 'meta meta_more' >";
                  articulo += "<a href = '" + post['url'] + "'>Leer Mas<i class='icon-right-open'></i></a>";
                  articulo += "</p>";
                  articulo += "</div>";
                  articulo += "</li>";
                  $(".slides").append(articulo);
            });
      });
});

