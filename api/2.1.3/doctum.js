

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '<ul><li data-name="namespace:RobBrazier" class="opened"><div style="padding-left:0px" class="hd"><span class="icon icon-play"></span><a href="RobBrazier.html">RobBrazier</a></div><div class="bd"><ul><li data-name="namespace:RobBrazier_Piwik" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="RobBrazier/Piwik.html">Piwik</a></div><div class="bd"><ul><li data-name="namespace:RobBrazier_Piwik_Facades" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="RobBrazier/Piwik/Facades.html">Facades</a></div><div class="bd"><ul><li data-name="class:RobBrazier_Piwik_Facades_Piwik" ><div style="padding-left:62px" class="hd leaf"><a href="RobBrazier/Piwik/Facades/Piwik.html">Piwik</a></div></li></ul></div></li><li data-name="class:RobBrazier_Piwik_Piwik" ><div style="padding-left:44px" class="hd leaf"><a href="RobBrazier/Piwik/Piwik.html">Piwik</a></div></li><li data-name="class:RobBrazier_Piwik_PiwikServiceProvider" ><div style="padding-left:44px" class="hd leaf"><a href="RobBrazier/Piwik/PiwikServiceProvider.html">PiwikServiceProvider</a></div></li></ul></div></li></ul></div></li></ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                        {"type":"Namespace","link":"RobBrazier.html","name":"RobBrazier","doc":"Namespace RobBrazier"},{"type":"Namespace","link":"RobBrazier/Piwik.html","name":"RobBrazier\\Piwik","doc":"Namespace RobBrazier\\Piwik"},{"type":"Namespace","link":"RobBrazier/Piwik/Facades.html","name":"RobBrazier\\Piwik\\Facades","doc":"Namespace RobBrazier\\Piwik\\Facades"},                                                        {"type":"Class","fromName":"RobBrazier\\Piwik\\Facades","fromLink":"RobBrazier/Piwik/Facades.html","link":"RobBrazier/Piwik/Facades/Piwik.html","name":"RobBrazier\\Piwik\\Facades\\Piwik","doc":null},
                                {"type":"Method","fromName":"RobBrazier\\Piwik\\Facades\\Piwik","fromLink":"RobBrazier/Piwik/Facades/Piwik.html","link":"RobBrazier/Piwik/Facades/Piwik.html#method_getFacadeAccessor","name":"RobBrazier\\Piwik\\Facades\\Piwik::getFacadeAccessor","doc":"<p>Get the registered name of the component.</p>"},
            
                                                {"type":"Class","fromName":"RobBrazier\\Piwik","fromLink":"RobBrazier/Piwik.html","link":"RobBrazier/Piwik/Piwik.html","name":"RobBrazier\\Piwik\\Piwik","doc":"<p>Class Piwik</p>"},
                                {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method___construct","name":"RobBrazier\\Piwik\\Piwik::__construct","doc":""},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method_actions","name":"RobBrazier\\Piwik\\Piwik::actions","doc":"<p>actions\nGet actions (hits) for the specific time period</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method_downloads","name":"RobBrazier\\Piwik\\Piwik::downloads","doc":"<p>downloads\nGet file downloads for the specific time period</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method_keywords","name":"RobBrazier\\Piwik\\Piwik::keywords","doc":"<p>keywords\nGet search keywords for the specific time period</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method_last_visits","name":"RobBrazier\\Piwik\\Piwik::last_visits","doc":"<p>last_visits\nGet information about last 10 visits (ip, time, country, pages, etc.)</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method_last_visits_parsed","name":"RobBrazier\\Piwik\\Piwik::last_visits_parsed","doc":"<p>last_visits_parsed\nGet information about last 10 visits (ip, time, country, pages, etc.) in a formatted array with GeoIP information if enabled</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method_outlinks","name":"RobBrazier\\Piwik\\Piwik::outlinks","doc":"<p>actions\nGet outlinks for the specific time period</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method_page_titles","name":"RobBrazier\\Piwik\\Piwik::page_titles","doc":"<p>page_titles\nGet page visit information for the specific time period</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method_search_engines","name":"RobBrazier\\Piwik\\Piwik::search_engines","doc":"<p>search_engines\nGet search engine referer information for the specific time period</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method_unique_visitors","name":"RobBrazier\\Piwik\\Piwik::unique_visitors","doc":"<p>unique_visitors\nGet unique visitors for the specific time period</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method_visits","name":"RobBrazier\\Piwik\\Piwik::visits","doc":"<p>visits\nGet all visits for the specific time period</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method_websites","name":"RobBrazier\\Piwik\\Piwik::websites","doc":"<p>websites\nGet refering websites (traffic sources) for the specific time period</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method_tag","name":"RobBrazier\\Piwik\\Piwik::tag","doc":"<p>tag\nGet javascript tag for use in tracking the website</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method_seo_rank","name":"RobBrazier\\Piwik\\Piwik::seo_rank","doc":"<p>seo_rank\nGet SEO Rank for the website</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method_version","name":"RobBrazier\\Piwik\\Piwik::version","doc":"<p>version\nGet Version of the Piwik Server</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\Piwik","fromLink":"RobBrazier/Piwik/Piwik.html","link":"RobBrazier/Piwik/Piwik.html#method_custom","name":"RobBrazier\\Piwik\\Piwik::custom","doc":""},
            
                                                {"type":"Class","fromName":"RobBrazier\\Piwik","fromLink":"RobBrazier/Piwik.html","link":"RobBrazier/Piwik/PiwikServiceProvider.html","name":"RobBrazier\\Piwik\\PiwikServiceProvider","doc":null},
                                {"type":"Method","fromName":"RobBrazier\\Piwik\\PiwikServiceProvider","fromLink":"RobBrazier/Piwik/PiwikServiceProvider.html","link":"RobBrazier/Piwik/PiwikServiceProvider.html#method_boot","name":"RobBrazier\\Piwik\\PiwikServiceProvider::boot","doc":"<p>Bootstrap the application events.</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\PiwikServiceProvider","fromLink":"RobBrazier/Piwik/PiwikServiceProvider.html","link":"RobBrazier/Piwik/PiwikServiceProvider.html#method_register","name":"RobBrazier\\Piwik\\PiwikServiceProvider::register","doc":"<p>Register the service provider.</p>"},
        {"type":"Method","fromName":"RobBrazier\\Piwik\\PiwikServiceProvider","fromLink":"RobBrazier/Piwik/PiwikServiceProvider.html","link":"RobBrazier/Piwik/PiwikServiceProvider.html#method_provides","name":"RobBrazier\\Piwik\\PiwikServiceProvider::provides","doc":"<p>Get the services provided by the provider.</p>"},
            
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

    root.Doctum = {
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
        Doctum.injectApiTree($('#api-tree'));
    });

    return root.Doctum;
})(window);

$(function() {

        // Enable the version switcher
    $('#version-switcher').on('change', function() {
        window.location = $(this).val()
    });
    var versionSwitcher = document.getElementById('version-switcher');
    if (versionSwitcher) {
        var versionToSelect = document.evaluate(
            '//option[@data-version="2.1.3"]',
            versionSwitcher,
            null,
            XPathResult.FIRST_ORDERED_NODE_TYPE,
            null
        ).singleNodeValue;

        if (versionToSelect && typeof versionToSelect.selected === 'boolean') {
            versionToSelect.selected = true;
        }
    }
    
    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').on('click', function() {
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
                cb(Doctum.search(q));
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


