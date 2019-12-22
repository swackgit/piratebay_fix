<?php class piratebay_fix extends Plugin {
        private $host;
        function about() {
                return array(1.02,
                        "fixes piratebay info page links",
                        "swack");
        }
        function init($host) {
                $this->host = $host;
                $host->add_hook($host::HOOK_ARTICLE_FILTER, $this);
        }
        function hook_article_filter($article) {
                // removes redundant http
                if(strpos($article["link"], "pirateproxy") !== FALSE)
                {
			$article["link"] = preg_replace('~(?:.*"https:\/\/pirateproxy.live\/)(.*?)(?:\".*)(?!\/>)~','\1',$article["content"]);
                        $subject = $article["content"];
                        $pattern = '~(https:\/\/pirateproxy.live\/)(.*?\")~';
                        $replace = '\2';
                        $article["content"] = preg_replace($pattern,$replace,$subject);
	                $article["author"] = 'piratebay';

                }
                return $article;
        }
        function api_version() {
                return 2;
        }
}
