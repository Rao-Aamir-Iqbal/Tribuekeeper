<?php

require 'database/db.php';
require 'functions/controller.php';

if(page=="" || page == "home")
{
  include html.'/pages/home-2.php';
}
else if(page == "home-2")
{
  include html.'/pages/home-3.php';
}


else if(page=="domain-registration"){
include html.'/pages/domain-registration.php';
}

else if(page=="web-hosting"){
include html.'/pages/web-hosting.php';
}

else if(page=="domain-pricing"){
include html.'/pages/domain-pricing.php';
}

else if(page=="move-to-hostcity"){
include html.'/pages/move-hostcity.php';
}


else if(page=="business-hosting-plans"){
include html.'/pages/business-hosting-plans.php';
}

else if(page=="plus-hosting-plans"){
include html.'/pages/plus-hosting-plans.php';
}

else if(page=="reseller-hosting-plans"){
include html.'/pages/reseller-hosting-plans.php';
}

else if(page=="email-hosting-plans"){
include html.'/pages/email-hosting-plans.php';
}

else if(page=="earn-with-hostcity"){
include html.'/pages/earn-with-hostcity.php';
}



else if(page=="vps-hosting"){
include html.'/pages/vps-hosting.php';
}





else if(page=="terms-of-service"){
include html.'/pages/terms-of-service.php';
}

else if(page=="knowledgebase"){
include html.'/pages/blog.php';
}

else if(page=="article-detail"){
include html.'/pages/article-detail.php';
}

else if(page=="article-category"){
include html.'/pages/article-category.php';
}

else if(page=="knowledge-search"){
include html.'/pages/knowledge-search.php';
}



// else if(page=="dom"){
// include html.'/pages/blog.php';
// }



else if(page=="best-web-hosting-company-in-pakistan"){
include html.'/pages/best-web-hosting-company-in-pakistan.php';
}


else{
  include html.'/pages/404.php';
}

?>
