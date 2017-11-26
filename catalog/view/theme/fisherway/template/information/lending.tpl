<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta charset="utf-8"></meta>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&amp;subset=latin,cyrillic,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,400italic&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <style>
        * { margin: 0; padding: 0;
        font-family: 'PT Sans Narrow', sans-serif;
        font-size: 12pt;
        line-height: 14pt;
        color: #666666;
        }
        b { font-size: 14pt;
        font-weight: bold;
        color: #336699
        }
        p { margin-bottom: 13px; }
        body {
        background-image: url(/image/lending/white_wave.png);
        }
        #wrapper {
        background-image: url(/image/lending/wrapper.png);
        width: 840px;
        height: 900px;
        margin: 0 auto;
        }
        #bott {
        background-image: url(/image/lending/bott.png);
        width: 840px;
        height: 40px;
        margin: 0 auto;
        }
        #header {
        background-image: url(/image/lending/header.png);
        background-repeat: no-repeat;
        background-position: left center;
        width: 840px;
        height: 150px;
        }
        #cont {
        background-image: url(/image/lending/cont.png);
        background-repeat: no-repeat;
        background-position: left center;
        float: left;
        width: 410px;
        height: 355px;
        padding-top: 105px;
        padding-left: 90px;
        text-align: left;
        }
        #regist {
        background-image: url(/image/lending/regist.png);
        background-repeat: no-repeat;
        background-position: left center;
        float: right;
        width: 340px;
        height: 460px;
        }
        #predlog {
        background-image: url(/image/lending/predlog.png);
        background-repeat: no-repeat;
        background-position: left center;
        float: left;
        padding-top: 80px;
        padding-left: 20px;
        width: 480px;
        height: 210px;
        }
        #tovar {
        margin-left: 10px;
        float: left;
        width: 150px;
        height: 100px;
        }
        #tovar p {
        padding-left: 20px;
        padding-right: 20px;
        text-align: center;
        height:40px;
        }
        #tovar img {
        width: 110px;
        height: 90px;
        margin-left: 20px; }
        #tovar span {
        padding-left: 50px;
        color: #FFFFFF; }
        #tovar span b {
        margin-left: 6px;
        margin-right: 6px;
        color: #FFFFFF; }
        #brands {
        background-image: url(/image/lending/brands.png);
        background-repeat: no-repeat;
        background-position: left center;
        float: right;
        padding-top: 230px;
        padding-right: 20px;
        width: 320px;
        height: 60px;
        text-align: center;
        color: #336699;
        }
        #brands span { color: #339999; }
        form {
        width: 210px;
        margin-left: 55px;
        margin-top: 95px;
        color: #FFFFFF;
        }
        form div{ color: #FFFFFF; }
        form p {
        text-align: center;
        font-family: 'PT Sans', sans-serif;
        font-size: 14pt;
        font-style: italic;
        color: #FFFFFF;
        }
        input.text {
        padding-left: 10px;
        padding-right: 10px;
        width: 190px;
        height: 31px;
        outline: none;
        border: none;
        margin-bottom: 11px;
        background: none;
        text-align: left;
        font-family: 'PT Sans', sans-serif;
        font-size: 12pt;
        font-style: italic;
        }
        input.checkbox {
        width: 14px;
        height: 14px;
        margin-right: 10px;
        background: none;
        }
        input.button {
        margin-top: 21px;
        width: 210px;
        height: 40px;
        border: none;
        background: none;
        cursor: pointer;
        }
        input.button:hover {
        background-image: url(/image/lending/button_hover.png);
        background-repeat: no-repeat;
        background-position: left center;
        width: 210px;
        height: 40px;
        }
        #help {
        position: absolute;
        margin-left: 250px;
        margin-top: 50px;
        }
        .thumbnail{
        width: 20px;
        height: 20px;
        float: left;
        position: relative;
        z-index: 0;
        }
        .thumbnail:hover{
        background-color: transparent;
        z-index: 50;
        }
        .thumbnail span{
        position: absolute;
        background-color: #CCFFFF;
        padding: 10px;
        width: 200px;
        left: -1000px;
        border: 1px solid #339999;
        visibility: hidden;
        color: #339999;
        text-align: left;
        text-decoration: none;

        }
        .thumbnail:hover span{
        visibility: visible;
        top: 0;
        left: 30px;
        }
        /*---------------------*/
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="header"></div>
        <div id="cont">
            <p>
                <b>СКИДКУ 10% ПРИ РЕГИСТРАЦИИ</b></br>
                на любой товар в клубном магазине</br>
            </p>
            <p>
                <b>ДЕНЬГИ НА ЛИЧНЫЙ СЧЕТ</b></br>
		если приводишь к нам друзей</br>
            </p>
            <p>
                <b>БЕСПЛАТНЫЙ ВХОД</b></br>
                на клубные мероприятия
            </p>
            <p>
                <b>ОГРОМНЫЕ СКИДКИ</b></br>
                от наших рыболовных партнеров</br>
            </p>

        </div>
        <div id="regist">
            <div id="help">
                <a class="thumbnail" href="#"><span>Здесь описаниеЗдесь описаниеЗдесь описаниеЗдесь описаниеЗдесь описаниеЗдесь описаниеЗдесь описание</span></a>
            </div>
            <form action="#" name="user-form">
                <div><input type="text" class="text" name="user-name" value="Имя*" onfocus="if(this.value=='Имя*'){this.value='';}" onblur="if(this.value==''){this.value='Имя*';}"/></div>
                <div><input type="mail" class="text" name="email" value="E-mail*" onfocus="if(this.value=='E-mail*'){this.value='';}" onblur="if(this.value==''){this.value='E-mail*';}"/></div>
                <p>Какую рыбалку предпочитаете?</p>
                <div style="float:left; height: 40px;">
                    <input type="checkbox" class="checkbox" name="option1" value="a1">Спиннинговая</br>
                    <input type="checkbox" class="checkbox" name="option2" value="a2">Карповая</br>
                </div>
                <div style="float:right; height: 40px;">
                    <input type="checkbox" class="checkbox" name="option3" value="a3">Поплавочная</br>
                    <input type="checkbox" class="checkbox" name="option4" value="a4">Фидерная</br>
                </div>
                <div><input type="submit" class="button" value=""/></div>
            </form>
        </div>
        <div id="predlog">
            <div id="tovar">
                <img src="/image/lending/1.png" alt="Воблер Megabass Pop Max" width="110px" height="90px"/>
                <p>Воблер Megabass Pop Max</p>
                <span>Цена:<b>200</b>грн</span>
            </div>
            <div id="tovar">
                <img src="/image/lending/2.png" alt="Воблер Megabass Pop Max" width="110px" height="90px"/>
                <p>Катушка Jaxon Hegemon HFR</p>
                <span>Цена:<b>520</b>грн</span>
            </div>
            <div id="tovar">
                <img src="/image/lending/3.png" alt="Воблер Megabass Pop Max" width="110px" height="90px"/>
                <p>Удилище Jaxon Inspiral Feeder</p>
                <span>Цена:<b>210</b>грн</span>
            </div>
        </div>
        <div id="brands">
            Copyright © 2013 - <b>FISHERWAY</b></br>
            <span>ПЕРВЫЙ ЗАКРЫТЫЙ КЛУБ РЫБОЛОВОВ</span>
        </div>
    </div>
    <div id="bott"></div>
</body>
</html>
