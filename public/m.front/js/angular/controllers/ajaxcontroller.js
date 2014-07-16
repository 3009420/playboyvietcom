/**
 * Created with JetBrains PhpStorm.
 * User: betapcode
 * Date: 11/19/13
 * Time: 1:20 PM
 * To change this template use File | Settings | File Templates.
 */

app.controller("AjaxController",function($scope,$http){
    $scope.datas = [];

    //Begin: load thanh vien noi bat
    /*
    $http.get('/ajax/promotedusers').success(function(data){
        $scope.datas = data;
    });
    */
    $http({method: 'JSONP', url: 'http://127.0.0.1/m.phototamtay.vn/api/promoteduser.json?callback=JSON_CALLBACK'}).
        success(function(data, status) {
            $scope.datas = data;
        }).
        error(function(data, status) {
            $scope.datas = data || "Request failed";
        });

    //End: load thanh vien noi bat

    //Begin: load hot nen xem nhat
    //$scope.datahot = [];
    //var title2 = "nụ cười ấy";
    /*
    $http.get('http://localhost/m.phototamtay.vn/ajax/promoted').success(function(datahot){
        $scope.datahot = datahot;
    });
    */
    $http({method: 'JSONP', url: 'http://localhost/m.phototamtay.vn/api/promoted.json?callback=JSON_CALLBACK'}).
        success(function(data, status) {
            $scope.datahot = data;
        }).
        error(function(data, status) {
            $scope.datahot = data || "Request failed";
        });
    $scope.quantity = 8;

    //End: load hot nen xem nhat

    //Begin: load goc ha noi
    $http({method: 'JSONP', url: 'http://localhost/m.phototamtay.vn/api/block_id_cate=123959.json&callback=JSON_CALLBACK'}).
        success(function(data, status) {
            $scope.hanoi = data;
        }).
        error(function(data, status) {
            $scope.hanoi = data || "Request failed";
        });
    //End: load goc ha noi

    //Begin: load tamtay club
    $http({method: 'JSONP', url: 'http://localhost/m.phototamtay.vn/api/block_id_cate=123915.josn&callback=JSON_CALLBACK'}).
        success(function(data, status) {
            $scope.ttclub = data;
        }).
        error(function(data, status) {
            $scope.ttclub = data || "Request failed";
        });
    //End: load tamtay club

    //helper js
    $scope.serverImg = function(serverid){
        if (serverid == 1){
            return 'http://img.tamtay.vn';
        }
        return 'http://img' + serverid + '.tamtay.vn';
    };

    $scope.friendlyUrl = function(title2){
        return codau2khongdau(title2);
        //return friendlyURL2(title2);
    };

    function str_replace(search, replace, subject, count) {
        // http://kevin.vanzonneveld.net
        // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   improved by: Gabriel Paderni
        // +   improved by: Philip Peterson
        // +   improved by: Simon Willison (http://simonwillison.net)
        // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
        // +   bugfixed by: Anton Ongson
        // +      input by: Onno Marsman
        // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +    tweaked by: Onno Marsman
        // +      input by: Brett Zamir (http://brett-zamir.me)
        // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   input by: Oleg Eremeev
        // +   improved by: Brett Zamir (http://brett-zamir.me)
        // +   bugfixed by: Oleg Eremeev
        // %          note 1: The count parameter must be passed as a string in order
        // %          note 1:  to find a global variable in which the result will be given
        // *     example 1: str_replace(' ', '.', 'Kevin van Zonneveld');
        // *     returns 1: 'Kevin.van.Zonneveld'
        // *     example 2: str_replace(['{name}', 'l'], ['hello', 'm'], '{name}, lars');
        // *     returns 2: 'hemmo, mars'
        var i = 0,
            j = 0,
            temp = '',
            repl = '',
            sl = 0,
            fl = 0,
            f = [].concat(search),
            r = [].concat(replace),
            s = subject,
            ra = Object.prototype.toString.call(r) === '[object Array]',
            sa = Object.prototype.toString.call(s) === '[object Array]';
        s = [].concat(s);
        if (count) {
            this.window[count] = 0;
        }

        for (i = 0, sl = s.length; i < sl; i++) {
            if (s[i] === '') {
                continue;
            }
            for (j = 0, fl = f.length; j < fl; j++) {
                temp = s[i] + '';
                repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
                s[i] = (temp).split(f[j]).join(repl);
                if (count && s[i] !== temp) {
                    this.window[count] += (temp.length - s[i].length) / f[j].length;
                }
            }
        }
        return sa ? s : s[0];
    };

    function strlen(string) {
        // http://kevin.vanzonneveld.net
        // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   improved by: Sakimori
        // +      input by: Kirk Strobeck
        // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   bugfixed by: Onno Marsman
        // +    revised by: Brett Zamir (http://brett-zamir.me)
        // %        note 1: May look like overkill, but in order to be truly faithful to handling all Unicode
        // %        note 1: characters and to this function in PHP which does not count the number of bytes
        // %        note 1: but counts the number of characters, something like this is really necessary.
        // *     example 1: strlen('Kevin van Zonneveld');
        // *     returns 1: 19
        // *     example 2: strlen('A\ud87e\udc04Z');
        // *     returns 2: 3
        var str = string + '';
        var i = 0,
            chr = '',
            lgth = 0;

        if (!this.php_js || !this.php_js.ini || !this.php_js.ini['unicode.semantics'] || this.php_js.ini['unicode.semantics'].local_value.toLowerCase() !== 'on') {
            return string.length;
        }

        var getWholeChar = function (str, i) {
            var code = str.charCodeAt(i);
            var next = '',
                prev = '';
            if (0xD800 <= code && code <= 0xDBFF) { // High surrogate (could change last hex to 0xDB7F to treat high private surrogates as single characters)
                if (str.length <= (i + 1)) {
                    throw 'High surrogate without following low surrogate';
                }
                next = str.charCodeAt(i + 1);
                if (0xDC00 > next || next > 0xDFFF) {
                    throw 'High surrogate without following low surrogate';
                }
                return str.charAt(i) + str.charAt(i + 1);
            } else if (0xDC00 <= code && code <= 0xDFFF) { // Low surrogate
                if (i === 0) {
                    throw 'Low surrogate without preceding high surrogate';
                }
                prev = str.charCodeAt(i - 1);
                if (0xD800 > prev || prev > 0xDBFF) { //(could change last hex to 0xDB7F to treat high private surrogates as single characters)
                    throw 'Low surrogate without preceding high surrogate';
                }
                return false; // We can pass over low surrogates now as the second component in a pair which we have already processed
            }
            return str.charAt(i);
        };

        for (i = 0, lgth = 0; i < str.length; i++) {
            if ((chr = getWholeChar(str, i)) === false) {
                continue;
            } // Adapt this line at the top of any loop, passing in the whole string and the current iteration and returning a variable to represent the individual character; purpose is to treat the first part of a surrogate pair as the whole character and then ignore the second part
            lgth++;
        }
        return lgth;
    }


    function substr(str, start, len) {
        // Returns part of a string
        //
        // version: 909.322
        // discuss at: http://phpjs.org/functions/substr
        // +     original by: Martijn Wieringa
        // +     bugfixed by: T.Wild
        // +      tweaked by: Onno Marsman
        // +      revised by: Theriault
        // +      improved by: Brett Zamir (http://brett-zamir.me)
        // %    note 1: Handles rare Unicode characters if 'unicode.semantics' ini (PHP6) is set to 'on'
        // *       example 1: substr('abcdef', 0, -1);
        // *       returns 1: 'abcde'
        // *       example 2: substr(2, 0, -6);
        // *       returns 2: false
        // *       example 3: ini_set('unicode.semantics',  'on');
        // *       example 3: substr('a\uD801\uDC00', 0, -1);
        // *       returns 3: 'a'
        // *       example 4: ini_set('unicode.semantics',  'on');
        // *       example 4: substr('a\uD801\uDC00', 0, 2);
        // *       returns 4: 'a\uD801\uDC00'
        // *       example 5: ini_set('unicode.semantics',  'on');
        // *       example 5: substr('a\uD801\uDC00', -1, 1);
        // *       returns 5: '\uD801\uDC00'
        // *       example 6: ini_set('unicode.semantics',  'on');
        // *       example 6: substr('a\uD801\uDC00z\uD801\uDC00', -3, 2);
        // *       returns 6: '\uD801\uDC00z'
        // *       example 7: ini_set('unicode.semantics',  'on');
        // *       example 7: substr('a\uD801\uDC00z\uD801\uDC00', -3, -1)
        // *       returns 7: '\uD801\uDC00z'
        // Add: (?) Use unicode.runtime_encoding (e.g., with string wrapped in "binary" or "Binary" class) to
        // allow access of binary (see file_get_contents()) by: charCodeAt(x) & 0xFF (see https://developer.mozilla.org/En/Using_XMLHttpRequest ) or require conversion first?
        var i = 0,
            allBMP = true,
            es = 0,
            el = 0,
            se = 0,
            ret = '';
        str += '';
        var end = str.length;

        // BEGIN REDUNDANT
        this.php_js = this.php_js || {};
        this.php_js.ini = this.php_js.ini || {};
        // END REDUNDANT
        switch ((this.php_js.ini['unicode.semantics'] && this.php_js.ini['unicode.semantics'].local_value.toLowerCase())) {
            case 'on':
                // Full-blown Unicode including non-Basic-Multilingual-Plane characters
                // strlen()
                for (i = 0; i < str.length; i++) {
                    if (/[\uD800-\uDBFF]/.test(str.charAt(i)) && /[\uDC00-\uDFFF]/.test(str.charAt(i + 1))) {
                        allBMP = false;
                        break;
                    }
                }

                if (!allBMP) {
                    if (start < 0) {
                        for (i = end - 1, es = (start += end); i >= es; i--) {
                            if (/[\uDC00-\uDFFF]/.test(str.charAt(i)) && /[\uD800-\uDBFF]/.test(str.charAt(i - 1))) {
                                start--;
                                es--;
                            }
                        }
                    } else {
                        var surrogatePairs = /[\uD800-\uDBFF][\uDC00-\uDFFF]/g;
                        while ((surrogatePairs.exec(str)) != null) {
                            var li = surrogatePairs.lastIndex;
                            if (li - 2 < start) {
                                start++;
                            } else {
                                break;
                            }
                        }
                    }

                    if (start >= end || start < 0) {
                        return false;
                    }
                    if (len < 0) {
                        for (i = end - 1, el = (end += len); i >= el; i--) {
                            if (/[\uDC00-\uDFFF]/.test(str.charAt(i)) && /[\uD800-\uDBFF]/.test(str.charAt(i - 1))) {
                                end--;
                                el--;
                            }
                        }
                        if (start > end) {
                            return false;
                        }
                        return str.slice(start, end);
                    } else {
                        se = start + len;
                        for (i = start; i < se; i++) {
                            ret += str.charAt(i);
                            if (/[\uD800-\uDBFF]/.test(str.charAt(i)) && /[\uDC00-\uDFFF]/.test(str.charAt(i + 1))) {
                                se++; // Go one further, since one of the "characters" is part of a surrogate pair
                            }
                        }
                        return ret;
                    }
                    break;
                }
            // Fall-through
            case 'off':
            // assumes there are no non-BMP characters;
            //    if there may be such characters, then it is best to turn it on (critical in true XHTML/XML)
            default:
                if (start < 0) {
                    start += end;
                }
                end = typeof len === 'undefined' ? end : (len < 0 ? len + end : len + start);
                // PHP returns false if start does not fall within the string.
                // PHP returns false if the calculated end comes before the calculated start.
                // PHP returns an empty string if start and end are the same.
                // Otherwise, PHP returns the portion of the string from start to end.
                return start >= str.length || start < 0 || start > end ? !1 : str.slice(start, end);
        }
        return undefined; // Please Netbeans
    }

    function strtolower(str) {
        // http://kevin.vanzonneveld.net
        // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   improved by: Onno Marsman
        // *     example 1: strtolower('Kevin van Zonneveld');
        // *     returns 1: 'kevin van zonneveld'
        return (str + '').toLowerCase();
    }

    function trim(str, charlist) {
        // http://kevin.vanzonneveld.net
        // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   improved by: mdsjack (http://www.mdsjack.bo.it)
        // +   improved by: Alexander Ermolaev (http://snippets.dzone.com/user/AlexanderErmolaev)
        // +      input by: Erkekjetter
        // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +      input by: DxGx
        // +   improved by: Steven Levithan (http://blog.stevenlevithan.com)
        // +    tweaked by: Jack
        // +   bugfixed by: Onno Marsman
        // *     example 1: trim('    Kevin van Zonneveld    ');
        // *     returns 1: 'Kevin van Zonneveld'
        // *     example 2: trim('Hello World', 'Hdle');
        // *     returns 2: 'o Wor'
        // *     example 3: trim(16, 1);
        // *     returns 3: 6
        var whitespace, l = 0,
            i = 0;
        str += '';

        if (!charlist) {
            // default list
            whitespace = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
        } else {
            // preg_quote custom list
            charlist += '';
            whitespace = charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '$1');
        }

        l = str.length;
        for (i = 0; i < l; i++) {
            if (whitespace.indexOf(str.charAt(i)) === -1) {
                str = str.substring(i);
                break;
            }
        }

        l = str.length;
        for (i = l - 1; i >= 0; i--) {
            if (whitespace.indexOf(str.charAt(i)) === -1) {
                str = str.substring(0, i + 1);
                break;
            }
        }

        return whitespace.indexOf(str.charAt(0)) === -1 ? str : '';
    }

    function preg_replace(pattern, pattern_replace, subject, limit){
        // Perform a regular expression search and replace
        //
        // discuss at: http://geekfg.net/
        // + original by: Francois-Guillaume Ribreau (http://fgribreau)
        // * example 1: preg_replace("/(\\@([^\\s,\\.]*))/ig",'<a href="http://twitter.com/\\0">\\1</a>','#followfriday @FGRibreau @GeekFG',1);
        // * returns 1: "#followfriday <a href="http://twitter.com/@FGRibreau">@FGRibreau</a> @GeekFG"
        // * example 2: preg_replace("/(\\@([^\\s,\\.]*))/ig",'<a href="http://twitter.com/\\0">\\1</a>','#followfriday @FGRibreau @GeekFG');
        // * returns 2: "#followfriday <a href="http://twitter.com/@FGRibreau">@FGRibreau</a> @GeekFG"
        // * example 3: preg_replace("/(\\#[^\\s,\\.]*)/ig",'<strong>$0</strong>','#followfriday @FGRibreau @GeekFG');
        // * returns 3: "<strong>#followfriday</strong> @FGRibreau @GeekFG"

        if(limit === undefined){
            limit = -1;
        }

        var _flag = pattern.substr(pattern.lastIndexOf(pattern[0])+1),
            _pattern = pattern.substr(1,pattern.lastIndexOf(pattern[0])-1),
            reg = new RegExp(_pattern,_flag),
            rs = null,
            res = [],
            x = 0,
            y = 0,
            ret = subject;

        if(limit === -1){
            var tmp = [];

            do{
                tmp = reg.exec(subject);
                if(tmp !== null){
                    res.push(tmp);
                }
            }while(tmp !== null && _flag.indexOf('g') !== -1)
        }
        else{
            res.push(reg.exec(subject));
        }

        for(x = res.length-1; x > -1; x--){//explore match
            tmp = pattern_replace;

            for(y = res[x].length - 1; y > -1; y--){
                tmp = tmp.replace('${'+y+'}',res[x][y])
                    .replace('$'+y,res[x][y])
                    .replace('\\'+y,res[x][y]);
            }
            ret = ret.replace(res[x][0],tmp);
        }
        return ret;
    }

    function codau2khongdau(string, alphabetOnly, tolower)
    {

        output = string;
        if(output != '')
        {
            //Tien hanh xu ly bo dau o day
            search = array('&#225;', '&#224;', '&#7843;', '&#227;', '&#7841;',                                 // a' a` a? a~ a.
                '&#259;', '&#7855;', '&#7857;', '&#7859;', '&#7861;', '&#7863;',        // a( a('
                '&#226;', '&#7845;', '&#7847;', '&#7849;', '&#7851;', '&#7853;',         // a^ a^'..
                '&#273;',                                                                                                                 // d-
                '&#233;', '&#232;', '&#7867;', '&#7869;', '&#7865;',                                // e' e`..
                '&#234;', '&#7871;', '&#7873;', '&#7875;', '&#7877;', '&#7879;',        // e^ e^'
                '&#237;', '&#236;', '&#7881;', '&#297;', '&#7883;',                                        // i' i`..
                '&#243;', '&#242;', '&#7887;', '&#245;', '&#7885;',                                        // o' o`..
                '&#244;', '&#7889;', '&#7891;', '&#7893;', '&#7895;', '&#7897;',        // o^ o^'..
                '&#417;', '&#7899;', '&#7901;', '&#7903;', '&#7905;', '&#7907;',        // o* o*'..
                '&#250;', '&#249;', '&#7911;', '&#361;', '&#7909;',                                        // u'..
                '&#432;', '&#7913;', '&#7915;', '&#7917;', '&#7919;', '&#7921;',        // u* u*'..
                '&#253;', '&#7923;', '&#7927;', '&#7929;', '&#7925;',                                // y' y`..

                '&#193;', '&#192;', '&#7842;', '&#195;', '&#7840;',                                        // A' A` A? A~ A.
                '&#258;', '&#7854;', '&#7856;', '&#7858;', '&#7860;', '&#7862;',        // A( A('..
                '&#194;', '&#7844;', '&#7846;', '&#7848;', '&#7850;', '&#7852;',        // A^ A^'..
                '&#272;',                                                                                                                        // D-
                '&#201;', '&#200;', '&#7866;', '&#7868;', '&#7864;',                                // E' E`..
                '&#202;', '&#7870;', '&#7872;', '&#7874;', '&#7876;', '&#7878;',        // E^ E^'..
                '&#205;', '&#204;', '&#7880;', '&#296;', '&#7882;',                                        // I' I`..
                '&#211;', '&#210;', '&#7886;', '&#213;', '&#7884;',                                        // O' O`..
                '&#212;', '&#7888;', '&#7890;', '&#7892;', '&#7894;', '&#7896;',        // O^ O^'..
                '&#416;', '&#7898;', '&#7900;', '&#7902;', '&#7904;', '&#7906;',        // O* O*'..
                '&#218;', '&#217;', '&#7910;', '&#360;', '&#7908;',                                        // U' U`..
                '&#431;', '&#7912;', '&#7914;', '&#7916;', '&#7918;', '&#7920;',        // U* U*'..
                '&#221;', '&#7922;', '&#7926;', '&#7928;', '&#7924;'                                // Y' Y`..
            );

            search2 = array('á', 'à', 'ả', 'ã', 'ạ',                                 // a' a` a? a~ a.
                'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ',        // a( a('
                'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ',         // a^ a^'..
                'đ',                                                                                                                 // d-
                'é', 'è', 'ẻ', 'ẽ', 'ẹ',                                // e' e`..
                'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ',        // e^ e^'
                'í', 'ì', 'ỉ', 'ĩ', 'ị',                                        // i' i`..
                'ó', 'ò', 'ỏ', 'õ', 'ọ',                                        // o' o`..
                'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ',        // o^ o^'..
                'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ',        // o* o*'..
                'ú', 'ù', 'ủ', 'ũ', 'ụ',                                        // u'..
                'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự',        // u* u*'..
                'ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ',                                // y' y`..

                'Á', 'À', 'Ả', 'Ã', 'Ạ',                                        // A' A` A? A~ A.
                'Ă', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ',        // A( A('..
                'Â', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ',        // A^ A^'..
                'Đ',                                                                                                                        // D-
                'É', 'È', 'Ẻ', 'Ẽ', 'Ẹ',                                // E' E`..
                'Ê', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ',        // E^ E^'..
                'Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị',                                        // I' I`..
                'Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ',                                        // O' O`..
                'Ô', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ộ',        // O^ O^'..
                'Ơ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ',        // O* O*'..
                'Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ',                                        // U' U`..
                'Ư', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự',        // U* U*'..
                'Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'                                // Y' Y`..
            );

            replace = array('a', 'a', 'a', 'a', 'a',
                'a', 'a', 'a', 'a', 'a', 'a',
                'a', 'a', 'a', 'a', 'a', 'a',
                'd',
                'e', 'e', 'e', 'e', 'e',
                'e', 'e', 'e', 'e', 'e', 'e',
                'i', 'i', 'i', 'i', 'i',
                'o', 'o', 'o', 'o', 'o',
                'o', 'o', 'o', 'o', 'o', 'o',
                'o', 'o', 'o', 'o', 'o', 'o',
                'u', 'u', 'u', 'u', 'u',
                'u', 'u', 'u', 'u', 'u', 'u',
                'y', 'y', 'y', 'y', 'y',

                'A', 'A', 'A', 'A', 'A',
                'A', 'A', 'A', 'A', 'A', 'A',
                'A', 'A', 'A', 'A', 'A', 'A',
                'D',
                'E', 'E', 'E', 'E', 'E',
                'E', 'E', 'E', 'E', 'E', 'E',
                'I', 'I', 'I', 'I', 'I',
                'O', 'O', 'O', 'O', 'O',
                'O', 'O', 'O', 'O', 'O', 'O',
                'O', 'O', 'O', 'O', 'O', 'O',
                'U', 'U', 'U', 'U', 'U',
                'U', 'U', 'U', 'U', 'U', 'U',
                'Y', 'Y', 'Y', 'Y', 'Y'
            );

            //print_r($search);
            output = str_replace(search, replace, output);
            output = str_replace(search2, replace, output);
            output = str_replace(" ", "-", output);
            output = str_replace(".","",output);
            output = str_replace("<","",output);
            output = str_replace(",","",output);
            output = str_replace("&","",output);
            output = str_replace("*","",output);
            output = str_replace("$","",output);
            output = str_replace("~","",output);

            /*
            if(alphabetOnly)
            {
                output = alphabetonly(output);
            }
            */
            if(tolower)
            {
                output = strtolower(output);
            }
        }

        return output;
    }



    function array () {
        // http://kevin.vanzonneveld.net
        // +   original by: d3x
        // +      improved by: Brett Zamir (http://brett-zamir.me)
        // *     example 1: array('Kevin', 'van', 'Zonneveld');
        // *     returns 1: ['Kevin', 'van', 'Zonneveld']
        // *     example 2: ini_set('phpjs.return_phpjs_arrays', 'on');
        // *     example 2: var arr = array({0:2}, {a:41}, {2:3}).change_key_case('CASE_UPPER').keys();
        // *     returns 2: [0,'A',2]

        var arrInst, e, __, that = this, PHPJS_Array = function PHPJS_Array() {},
            mainArgs = arguments, p = this.php_js = this.php_js || {},
            _indexOf = function (value, from, strict) {
                var i = from || 0, nonstrict = !strict, length = this.length;
                while (i < length) {
                    if (this[i] === value || (nonstrict && this[i] == value)) {
                        return i;
                    }
                    i++;
                }
                return -1;
            };
        // BEGIN REDUNDANT
        if (!p.Relator) {
            p.Relator = (function () {// Used this functional class for giving privacy to the class we are creating
                // Code adapted from http://www.devpro.it/code/192.html
                // Relator explained at http://webreflection.blogspot.com/2008/07/javascript-relator-object-aka.html
                // Its use as privacy technique described at http://webreflection.blogspot.com/2008/10/new-relator-object-plus-unshared.html
                // 1) At top of closure, put: var __ = Relator.$();
                // 2) In constructor, put: var _ = __.constructor(this);
                // 3) At top of each prototype method, put: var _ = __.method(this);
                // 4) Use like:  _.privateVar = 5;
                function _indexOf (value) {
                    var i = 0, length = this.length;
                    while (i < length) {
                        if (this[i] === value) {
                            return i;
                        }
                        i++;
                    }
                    return -1;
                }
                function Relator () {
                    var Stack = [], Array = [];
                    if (!Stack.indexOf) {
                        Stack.indexOf = _indexOf;
                    }
                    return {
                        // create a new relator
                        $ : function () {
                            return Relator();
                        },
                        constructor : function (that) {
                            var i = Stack.indexOf(that);
                            ~i ? Array[i] : Array[Stack.push(that) - 1] = {};
                            this.method(that).that = that;
                            return this.method(that);
                        },
                        method : function (that) {
                            return Array[Stack.indexOf(that)];
                        }
                    };
                }
                return Relator();
            }());
        }
        // END REDUNDANT

        if (p && p.ini && p.ini['phpjs.return_phpjs_arrays'].local_value.toLowerCase() === 'on') {
            if (!p.PHPJS_Array) {
                // We keep this Relator outside the class in case adding prototype methods below
                // Prototype methods added elsewhere can also use this ArrayRelator to share these "pseudo-global mostly-private" variables
                __ = p.ArrayRelator = p.ArrayRelator || p.Relator.$();
                // We could instead allow arguments of {key:XX, value:YY} but even more cumbersome to write
                p.PHPJS_Array = function PHPJS_Array () {
                    var _ = __.constructor(this), args = arguments, i = 0, argl, p;
                    args = (args.length === 1 && args[0] && typeof args[0] === 'object' &&
                        args[0].length && !args[0].propertyIsEnumerable('length')) ? args[0] : args; // If first and only arg is an array, use that (Don't depend on this)
                    if (!_.objectChain) {
                        _.objectChain = args;
                        _.object = {};
                        _.keys = [];
                        _.values = [];
                    }
                    for (argl = args.length; i < argl; i++) {
                        for (p in args[i]) {
                            // Allow for access by key; use of private members to store sequence allows these to be iterated via for...in (but for read-only use, with hasOwnProperty or function filtering to avoid prototype methods, and per ES, potentially out of order)
                            this[p] = _.object[p] = args[i][p];
                            // Allow for easier access by prototype methods
                            _.keys[_.keys.length] = p;
                            _.values[_.values.length] = args[i][p];
                            break;
                        }
                    }
                };
                e = p.PHPJS_Array.prototype;
                e.change_key_case = function (cs) {
                    var _ = __.method(this), oldkey, newkey, i = 0, kl = _.keys.length,
                        case_fn = (!cs || cs === 'CASE_LOWER') ? 'toLowerCase' : 'toUpperCase';
                    while (i < kl) {
                        oldkey = _.keys[i];
                        newkey = _.keys[i] = _.keys[i][case_fn]();
                        if (oldkey !== newkey) {
                            this[oldkey] = _.object[oldkey] = _.objectChain[i][oldkey] = null; // Break reference before deleting
                            delete this[oldkey];
                            delete _.object[oldkey];
                            delete _.objectChain[i][oldkey];
                            this[newkey] = _.object[newkey] = _.objectChain[i][newkey] = _.values[i]; // Fix: should we make a deep copy?
                        }
                        i++;
                    }
                    return this;
                };
                e.flip = function () {
                    var _ = __.method(this), i = 0, kl = _.keys.length;
                    while (i < kl) {
                        oldkey = _.keys[i];
                        newkey = _.values[i];
                        if (oldkey !== newkey) {
                            this[oldkey] = _.object[oldkey] = _.objectChain[i][oldkey] = null; // Break reference before deleting
                            delete this[oldkey];
                            delete _.object[oldkey];
                            delete _.objectChain[i][oldkey];
                            this[newkey] = _.object[newkey] = _.objectChain[i][newkey] = oldkey;
                            _.keys[i] = newkey;
                        }
                        i++;
                    }
                    return this;
                };
                e.walk = function (funcname, userdata) {
                    var _ = __.method(this), obj, func, ini, i = 0, kl = 0;

                    try {
                        if (typeof funcname === 'function') {
                            for (i = 0, kl = _.keys.length; i < kl; i++) {
                                if (arguments.length > 1) {
                                    funcname(_.values[i], _.keys[i], userdata);
                                }
                                else {
                                    funcname(_.values[i], _.keys[i]);
                                }
                            }
                        }
                        else if (typeof funcname === 'string') {
                            this.php_js = this.php_js || {};
                            this.php_js.ini = this.php_js.ini || {};
                            ini = this.php_js.ini['phpjs.no-eval'];
                            if (ini && (
                                parseInt(ini.local_value, 10) !== 0 && (!ini.local_value.toLowerCase || ini.local_value.toLowerCase() !== 'off')
                                )) {
                                if (arguments.length > 1) {
                                    for (i = 0, kl = _.keys.length; i < kl; i++) {
                                        this.window[funcname](_.values[i], _.keys[i], userdata);
                                    }
                                }
                                else {
                                    for (i = 0, kl = _.keys.length; i < kl; i++) {
                                        this.window[funcname](_.values[i], _.keys[i]);
                                    }
                                }
                            }
                            else {
                                if (arguments.length > 1) {
                                    for (i = 0, kl = _.keys.length; i < kl; i++) {
                                        eval(funcname + '(_.values[i], _.keys[i], userdata)');
                                    }
                                }
                                else {
                                    for (i = 0, kl = _.keys.length; i < kl; i++) {
                                        eval(funcname + '(_.values[i], _.keys[i])');
                                    }
                                }
                            }
                        }
                        else if (funcname && typeof funcname === 'object' && funcname.length === 2) {
                            obj = funcname[0];
                            func = funcname[1];
                            if (arguments.length > 1) {
                                for (i = 0, kl = _.keys.length; i < kl; i++) {
                                    obj[func](_.values[i], _.keys[i], userdata);
                                }
                            }
                            else {
                                for (i = 0, kl = _.keys.length; i < kl; i++) {
                                    obj[func](_.values[i], _.keys[i]);
                                }
                            }
                        }
                        else {
                            return false;
                        }
                    }
                    catch (e) {
                        return false;
                    }

                    return this;
                };
                // Here we'll return actual arrays since most logical and practical for these functions to do this
                e.keys = function (search_value, argStrict) {
                    var _ = __.method(this), pos,
                        search = typeof search_value !== 'undefined',
                        tmp_arr = [],
                        strict = !!argStrict;
                    if (!search) {
                        return _.keys;
                    }
                    while ((pos = _indexOf(_.values, pos, strict)) !== -1) {
                        tmp_arr[tmp_arr.length] = _.keys[pos];
                    }
                    return tmp_arr;
                };
                e.values = function () {var _ = __.method(this);
                    return _.values;
                };
                // Return non-object, non-array values, since most sensible
                e.search = function (needle, argStrict) {
                    var _ = __.method(this),
                        strict = !!argStrict, haystack = _.values, i, vl, val, flags;
                    if (typeof needle === 'object' && needle.exec) { // Duck-type for RegExp
                        if (!strict) { // Let's consider case sensitive searches as strict
                            flags = 'i' + (needle.global ? 'g' : '') +
                                (needle.multiline ? 'm' : '') +
                                (needle.sticky ? 'y' : ''); // sticky is FF only
                            needle = new RegExp(needle.source, flags);
                        }
                        for (i=0, vl = haystack.length; i < vl; i++) {
                            val = haystack[i];
                            if (needle.test(val)) {
                                return _.keys[i];
                            }
                        }
                        return false;
                    }
                    for (i = 0, vl = haystack.length; i < vl; i++) {
                        val = haystack[i];
                        if ((strict && val === needle) || (!strict && val == needle)) {
                            return _.keys[i];
                        }
                    }
                    return false;
                };
                e.sum = function () {
                    var _ = __.method(this), sum = 0, i = 0, kl = _.keys.length;
                    while (i < kl) {
                        if (!isNaN(parseFloat(_.values[i]))) {
                            sum += parseFloat(_.values[i]);
                        }
                        i++;
                    }
                    return sum;
                };
                // Experimental functions
                e.foreach = function (handler) {
                    var _ = __.method(this), i = 0, kl = _.keys.length;
                    while (i < kl) {
                        if (handler.length === 1) {
                            handler(_.values[i]); // only pass the value
                        }
                        else {
                            handler(_.keys[i], _.values[i]);
                        }
                        i++;
                    }
                    return this;
                };
                e.list = function () {
                    var key, _ = __.method(this), i = 0, argl = arguments.length;
                    while (i < argl) {
                        key = _.keys[i];
                        if (key && key.length === parseInt(key, 10).toString().length && // Key represents an int
                            parseInt(key, 10) < argl) { // Key does not exceed arguments
                            that.window[arguments[key]] = _.values[key];
                        }
                        i++;
                    }
                    return this;
                };
                // Parallel functionality and naming of built-in JavaScript array methods
                e.forEach = function (handler) {
                    var _ = __.method(this), i = 0, kl = _.keys.length;
                    while (i < kl) {
                        handler(_.values[i], _.keys[i], this);
                        i++;
                    }
                    return this;
                };
                // Our own custom convenience functions
                e.$object = function () {var _ = __.method(this);
                    return _.object;
                };
                e.$objectChain = function () {var _ = __.method(this);
                    return _.objectChain;
                };
            }
            PHPJS_Array.prototype = p.PHPJS_Array.prototype;
            arrInst = new PHPJS_Array();
            p.PHPJS_Array.apply(arrInst, mainArgs);
            return arrInst;
        }
        return Array.prototype.slice.call(mainArgs);
    }




});