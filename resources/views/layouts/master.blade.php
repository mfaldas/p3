<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Katy Perry's Bill Splitter</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">

    <link href='/css/p3Style.css' rel='stylesheet'>

</head>

<body>

<div class="parent">

    <img src="/images/_KatyPerryLogo.png" alt="Katy Perry Logo" id="kpl">
    <h1>Bill Splitter</h1>

    <br>

    <div class="row">

        <div class="col-sm-6">
            <label>*Split:

                <input type="text"
                       name="split"
                       class="splitTextBox"
                       value=""
                       required>
            </label>

            <br>

            <label>*Bill: $
                <input type="text"
                       name="bill"
                       class="billTextBox"
                       value=""
                       required>
            </label>

            <p>
                <small><em>*Required Inputs</em></small>
            </p>

        </div>

        <div class="col-sm-3">
            <label class="tipLabel">Tip:
                <select name="tip" class="tipDropdown">
                    <option value="1">No Tip</option>
                    <option value="1.10">10% Tip</option>
                    <option value="1.15">15% Tip</option>
                    <option value="1.20">20% Tip</option>
                </select>
            </label>
        </div>

        <div class="col-sm-3">
            <label>Round Up:
                <input type="checkbox" name="roundUp" value="1">
            </label>
        </div>
    </div>


    <input type="submit" value="Split It Girl!" class="splitButton" name="submit">


    <br>

    <div class="standard"> @yield("result")
    </div>


</div>
</body>

</html>