<?php require 'language.php'; ?>
<html dir="<?php print $lang['lang_dir']; ?>" lang="<?php print $lang_key; ?>">
<head>
    <title data-lang="perceptual_color_diff"><?php print $lang['perceptual_color_diff']; ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta property="og:image" content="pageicon.png" />
    <meta property="og:description"
          content="<?php print $lang['og_description'] ?>"/>

    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script>
        var questions = [];
        var questionIndex = 0;
        var handleClick = false;
        var isUpdate = false;
        var backEnabled = false;
        var wantToAnswer = 50;
        var lang = <?php print json_encode($Lang); ?>;
        var lang_key = '<?php print $lang_key; ?>';
        $(document).ready(function(){
            loadQuestions().then(function(){
                showQuestion(questions[0]);
            });

            $('.button_yes').click({answer:1}, answerClick);
            $('.button_no').click({answer:0}, answerClick);
            $('#lang').click(function() {

                lang_key = getText('next_lang');
                $('[data-lang]').each(function (i, t) {
                    $(t).html(getText($(t).attr('data-lang')));
                });
                $('#lang').text(lang[getText('next_lang')]['lang_name']);
                $(document).attr('dir', getText('lang_dir'));
                $('html').attr('lang', lang_key);
            });
            $('#start1').click(function(){
                disableBack();
                $('.menu').fadeOut(function(){
                    $('.quiz1').fadeIn();
                });
            });
            $('#back_button').click(backClick);
            $('#continue_button').click(continueClick);
            $('#restart_button').click(restartClick);
            $('#menu_button').click( function() {
                resetCounter();
                $('.thanks').fadeOut(function () {
                    $('.menu').fadeIn();
                });
            });
            $('#end_button').click(endClick);
        });

        function endClick() {
            $('.quiz1').fadeOut().promise().done(function() {
                wantToAnswer = questionIndex + 50;
                disableBack();
                $('#q_amount').html(wantToAnswer);
                $('.thanks').fadeIn();
            });
        }

        function getText(key_) {
            return lang[lang_key][key_];
        }

        function continueClick() {
            $('.thanks').fadeOut(function() {
                $('.quiz1').fadeIn();
            });
        }

        function restartClick() {
            resetCounter();
            $('.thanks').fadeOut(function() {
                $('.quiz1').fadeIn();
            });
        }

        function resetCounter() {
            questions = questions.slice(questionIndex + 1);
            questionIndex = 0;
            wantToAnswer = 50;
            $('#q_amount').text('50');
            $('#q_number').text('1');
            showQuestion(questions[0]);
        }

        function answerClick(event) {
            if(!handleClick) return;
            handleClick = false;
            var className = event.target.className;
            answer(questions[questionIndex], event.data.answer);
            if(questionIndex+1 < wantToAnswer) {
                next_question();
            } else {
                $('.quiz1').fadeOut().promise().done(function(){
                    disableBack();
                    wantToAnswer += 50;
                    $('#q_amount').html(wantToAnswer);
                    next_question();
                    $('.thanks').fadeIn();
                });
            }
        }

        function backClick() {
            if(backEnabled) {
                disableBack();
                isUpdate = true;
                questionIndex--;
                $('#q_number').html(questionIndex + 1);
                showQuestion(questions[questionIndex]);
            }
        }
        function enableBack() {
            backEnabled = true;
            $('#back_button').toggleClass("img_disabled", false);
        }
        function disableBack() {
            backEnabled = false;
            $('#back_button').toggleClass("img_disabled", true);
        }

        function next_question() {
            questionIndex++;
            $('#q_number').html(questionIndex+1);
            if(Object.keys(questions).length - questionIndex < 10){
                loadQuestions();
            }
            enableBack();
            isUpdate = false;
            return showQuestion(questions[questionIndex]);
        }

        function answer(q, is_similar){
            var req_page = isUpdate ? 'update_answer.php' : 'answer.php';
            $.get(req_page, {'color_a': q[0], 'color_b': q[1], 'answer': is_similar});
        }

        function loadQuestions() {
            var amount = 30;
            return $.getJSON("load.php", { 'amount': amount }, function(result){
                $.merge(questions, result);
            });
        }

        function showQuestion(q) {
            var defer = $.when(changeColor($('#c1'), q[0]),
                changeColor($('#c2'), q[1]));
            defer.then(function(){
                handleClick = true;});
            return defer;
        }

        function changeColor(_element, color) {
            color = "#" + color;
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
    <tr><td class="text" " data-lang="about"><?php print $lang['about']; ?></td></tr>
    <tr><td class="menu_button" id="start1" data-lang="startquiz1"><?php print $lang['startquiz1']; ?></td></tr>
    <tr><td class="menu_button" id="lang"><?php print $Lang[$lang['next_lang']]['lang_name']; ?></td></tr>
</table>
<table class="quiz1 tb1">
    <tr><td class="top" style="width: 82%; position: relative">
            <div style="
    position: absolute;
    top: 0;
    right: 0;
    width: 5vh;
    height: 5vh;
    margin: 1.93vh 1.25vh;
"><img id="end_button" class="img_button" src="Delete.png"></div>
            <div style="
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    padding-right: 3vh;
    font-size: 2vh;
    padding-bottom: 0.5vh;
    width: 100%;
    line-height: 110%;
" data-lang="please_answer_only_when"><?php print $lang['please_answer_only_when']; ?></div>
            <div style="padding-right: 6.25vh; padding-bottom: 3vh; line-height: 105%;" data-lang="is_there_any_similarity"><?php print $lang['is_there_any_similarity']; ?></div>
        </td>
        <td class="top">
            <div class="top-left">
                <img id="back_button" class="img_button img_disabled" src="Undo.png" style="
                            max-height: 100%;
                            max-width: 100%;
                            position: absolute;
                            left: 0.5vh;
                            top: 50%;
                            transform: translateY(-70%);
                        ">
                <div style="
                        font-size: 2vh;
                        position: absolute;
                        bottom: 0;
                        left: 0;
                        padding: 0.6vh;
                        ">
                    <span data-lang="question"><?php print $lang['question']; ?></span><span> </span><span style="font-size: 1.8vh;"><span id="q_number">1</span>/<span id="q_amount">50</span></span>
                </div>
        </td></tr>
    <tr id="c1" class="color"><td colspan="2"></td></tr>
    <tr id="c2" class="color"><td colspan="2">
        </td></tr>
</table>
<table class="quiz1 tb2">
    <tr class="buttons">
        <td class="button_yes" data-lang="similar"><?php print $lang['similar']; ?></td>
        <td class="button_no" data-lang="unsimilar"><?php print $lang['unsimilar']; ?></td>
    </tr>
</table>
<table class="thanks">
    <tr><td class="text" data-lang="thanks!"><?php print $lang['thanks!']; ?></td></tr>
    <tr><td class="thanks_button" id="restart_button" data-lang="restart"><?php print $lang['restart']; ?></td></tr>
    <tr><td class="thanks_button" id="continue_button" data-lang="continue"><?php print $lang['continue']; ?></td></tr>
    <tr><td class="thanks_button" id="menu_button" data-lang="menu"><?php print $lang['menu']; ?></td></tr>
</table>
</body>
</html>