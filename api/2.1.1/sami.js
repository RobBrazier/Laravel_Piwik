
window.projectVersion = '2.1.1';

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:RobBrazier" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="RobBrazier.html">RobBrazier</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:RobBrazier_Piwik" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="RobBrazier/Piwik.html">Piwik</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:RobBrazier_Piwik_Facades" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="RobBrazier/Piwik/Facades.html">Facades</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:RobBrazier_Piwik_Facades_Piwik" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="RobBrazier/Piwik/Facades/Piwik.html">Piwik</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:RobBrazier_Piwik_Piwik" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="RobBrazier/Piwik/Piwik.html">Piwik</a>                    </div>                </li>                            <li data-name="class:RobBrazier_Piwik_PiwikServiceProvider" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="RobBrazier/Piwik/PiwikServiceProvider.html">PiwikServiceProvider</a>                    </div>                </li>                </ul></div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "RobBrazier.html", "name": "RobBrazier", "doc": "Namespace RobBrazier"},{"type": "Namespace", "link": "RobBrazier/Piwik.html", "name": "RobBrazier\\Piwik", "doc": "Namespace RobBrazier\\Piwik"},{"type": "Namespace", "link": "RobBrazier/Piwik/Facades.html", "name": "RobBrazier\\Piwik\\Facades", "doc": "Namespace RobBrazier\\Piwik\\Facades"},
            
            {"type": "Class", "fromName": "RobBrazier\\Piwik\\Facades", "fromLink": "RobBrazier/Piwik/Facades.html", "link": "RobBrazier/Piwik/Facades/Piwik.html", "name": "RobBrazier\\Piwik\\Facades\\Piwik", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "RobBrazier\\Piwik\\Facades\\Piwik", "fromLink": "RobBrazier/Piwik/Facades/Piwik.html", "link": "RobBrazier/Piwik/Facades/Piwik.html#method_getFacadeAccessor", "name": "RobBrazier\\Piwik\\Facades\\Piwik::getFacadeAccessor", "doc": "&quot;Get the registered name of the component.&quot;"},
            
            {"type": "Class", "fromName": "RobBrazier\\Piwik", "fromLink": "RobBrazier/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html", "name": "RobBrazier\\Piwik\\Piwik", "doc": "&quot;Class Piwik&quot;"},
                                                        {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method___construct", "name": "RobBrazier\\Piwik\\Piwik::__construct", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method_actions", "name": "RobBrazier\\Piwik\\Piwik::actions", "doc": "&quot;actions\nGet actions (hits) for the specific time period&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method_downloads", "name": "RobBrazier\\Piwik\\Piwik::downloads", "doc": "&quot;downloads\nGet file downloads for the specific time period&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method_keywords", "name": "RobBrazier\\Piwik\\Piwik::keywords", "doc": "&quot;keywords\nGet search keywords for the specific time period&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method_last_visits", "name": "RobBrazier\\Piwik\\Piwik::last_visits", "doc": "&quot;last_visits\nGet information about last 10 visits (ip, time, country, pages, etc.)&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method_last_visits_parsed", "name": "RobBrazier\\Piwik\\Piwik::last_visits_parsed", "doc": "&quot;last_visits_parsed\nGet information about last 10 visits (ip, time, country, pages, etc.) in a formatted array with GeoIP information if enabled&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method_outlinks", "name": "RobBrazier\\Piwik\\Piwik::outlinks", "doc": "&quot;actions\nGet outlinks for the specific time period&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method_page_titles", "name": "RobBrazier\\Piwik\\Piwik::page_titles", "doc": "&quot;page_titles\nGet page visit information for the specific time period&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method_search_engines", "name": "RobBrazier\\Piwik\\Piwik::search_engines", "doc": "&quot;search_engines\nGet search engine referer information for the specific time period&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method_unique_visitors", "name": "RobBrazier\\Piwik\\Piwik::unique_visitors", "doc": "&quot;unique_visitors\nGet unique visitors for the specific time period&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method_visits", "name": "RobBrazier\\Piwik\\Piwik::visits", "doc": "&quot;visits\nGet all visits for the specific time period&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method_websites", "name": "RobBrazier\\Piwik\\Piwik::websites", "doc": "&quot;websites\nGet refering websites (traffic sources) for the specific time period&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method_tag", "name": "RobBrazier\\Piwik\\Piwik::tag", "doc": "&quot;tag\nGet javascript tag for use in tracking the website&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method_seo_rank", "name": "RobBrazier\\Piwik\\Piwik::seo_rank", "doc": "&quot;seo_rank\nGet SEO Rank for the website&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method_version", "name": "RobBrazier\\Piwik\\Piwik::version", "doc": "&quot;version\nGet Version of the Piwik Server&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\Piwik", "fromLink": "RobBrazier/Piwik/Piwik.html", "link": "RobBrazier/Piwik/Piwik.html#method_custom", "name": "RobBrazier\\Piwik\\Piwik::custom", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "RobBrazier\\Piwik", "fromLink": "RobBrazier/Piwik.html", "link": "RobBrazier/Piwik/PiwikServiceProvider.html", "name": "RobBrazier\\Piwik\\PiwikServiceProvider", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "RobBrazier\\Piwik\\PiwikServiceProvider", "fromLink": "RobBrazier/Piwik/PiwikServiceProvider.html", "link": "RobBrazier/Piwik/PiwikServiceProvider.html#method_boot", "name": "RobBrazier\\Piwik\\PiwikServiceProvider::boot", "doc": "&quot;Bootstrap the application events.&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\PiwikServiceProvider", "fromLink": "RobBrazier/Piwik/PiwikServiceProvider.html", "link": "RobBrazier/Piwik/PiwikServiceProvider.html#method_register", "name": "RobBrazier\\Piwik\\PiwikServiceProvider::register", "doc": "&quot;Register the service provider.&quot;"},
                    {"type": "Method", "fromName": "RobBrazier\\Piwik\\PiwikServiceProvider", "fromLink": "RobBrazier/Piwik/PiwikServiceProvider.html", "link": "RobBrazier/Piwik/PiwikServiceProvider.html#method_provides", "name": "RobBrazier\\Piwik\\PiwikServiceProvider::provides", "doc": "&quot;Get the services provided by the provider.&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


