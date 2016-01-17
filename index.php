<?php require 'language.php'; ?>
<html dir="<?php print $lang['lang_dir']; ?>">
    <head>
        <title data-lang="perceptual_color_diff"><?php print $lang['perceptual_color_diff']; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>
            var questions = [];
            var questionIndex = 0;
            var handleClick = false;
            var lang = <?php print json_encode($Lang); ?>;
            var lang_key = '<?php print $lang_key; ?>';
            $(document).ready(function(){
                loadQuestions().then(function(){
                    showQuestion(questions[0]);                    
                });
                
                $('.button_yes').click({answer:1}, answerClick);
                $('.button_no').click({answer:0}, answerClick);
                $('#lang').click(function(){
                    lang_key = lang[lang_key]['next_lang'];
                   $('[data-lang]').each(function(i,t){
                        $(t).text(lang[lang_key][$(t).attr('data-lang')]);
                   });
                   $('#lang').text(lang[lang[lang_key]['next_lang']]['lang_name']);
                   $(document).attr('dir', lang[lang_key]['lang_dir']);
                });
                $('#start1').click(function(){
                    $('.menu').fadeOut(function(){
                        $('.quiz1').fadeIn();
                    });
                });
            });
            
            function answerClick(event) {
                if(!handleClick) return;
                handleClick = false;
                var className = event.target.className;
                var activeClass = className + "_active";
                $(event.target).addClass(activeClass).removeClass(className);
                answer(questions[questionIndex]['qid'], event.data.answer);
                next_question().then(function(){
                    $(event.target).addClass(className).removeClass(activeClass);
                });
            }
            
            function next_question() {
                questionIndex++;
                if(Object.keys(questions).length - questionIndex < 10){
                    loadQuestions();
                }
                return showQuestion(questions[questionIndex]);
            }
            
            function answer(qid, is_similar){
                $.get('answer.php', {'qid': qid, 'answer': is_similar});
            }
            
            function loadQuestions() {
                var amount = 30;
                return $.getJSON("load.php", { 'amount': amount }, function(result){
                    $.merge(questions, result);
                });
            }
            
            function showQuestion(q) {
                var defer = $.when(changeColor($('#c1'), q['color_a']),
                changeColor($('#c2'), q['color_b']));
                defer.then(function(){
                handleClick = true;});
                return defer;
            }
            
            function changeColor(_element, color) {
               
               var defer = $.Deferred();
                _element.css({'background-image': 'linear-gradient('
                    +color+', '+color+')',
                    'background-size': '100% 100%',
                    'transition': 'background-size .3s'});
                setTimeout(function(){
                        _element.css({'background-color': color, 
                        'background-size': '0% 100%'});
                    setTimeout(function(){defer.resolve();}, 150);
                }, 300);
                return defer.promise();
            }
        </script>
    </head>
    <body>
        <table class="menu">
            <tr id="about"><td class="menu_button" data-lang="about"><?php print $lang['about']; ?></td></tr>
            <tr><td class="menu_button" id="start1" data-lang="startquiz1"><?php print $lang['startquiz1']; ?></td></tr>
            <tr><td class="menu_button" id="lang"><?php print $Lang[$lang['next_lang']]['lang_name']; ?></td></tr>
        </table>
        <table class="quiz1 tb1">
            <tr><td class="top" colspan="2" data-lang="is_there_any_similarity">
                <?php print $lang['is_there_any_similarity']; ?></td></tr>
            <tr id="c1" class="color"><td colspan="2"></td></tr>
            <tr id="c2" class="color"><td colspan="2"></td></tr>
        </table>
        <table class="quiz1 tb2">
            <tr class="buttons">
                <td class="button_yes" data-lang="similar"><?php print $lang['similar']; ?></td>
                <td class="button_no" data-lang="unsimilar"><?php print $lang['unsimilar']; ?></td>
            </tr>
        </table>
        <?php
            
        ?>
    </body>
</html>