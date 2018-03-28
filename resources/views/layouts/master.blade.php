<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Katy Perry's Bill Splitter</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <link href='/css/p3Style.css' rel='stylesheet'>

</head>

<body>

<div class="parent">

    <img src="/images/_KatyPerryLogo.png" alt="Katy Perry Logo" id="kpl">
    <h1>Bill Splitter</h1>

    <br>

    <form method='GET' action='/show'>

        <div class="row">

            <div class="col-sm-6">
                <label>*Split:

                    <input type="text"
                           name="split"
                           class="splitTextBox"
                           value="{{ old('split') }}"
                           placeholder="4"
                           required>
                    @include('modules.error-field', ['field' => 'split'])
                </label>

                <br>

                <label>*Bill: $
                    <input type="text"
                           name="bill"
                           class="billTextBox"
                           value="{{ old('bill') }}"
                           placeholder='62.51'
                           required>
                    @include('modules.error-field', ['field' => 'bill'])
                </label>

                <p>
                    <small><em>*Required Inputs</em></small>
                </p>

            </div>

            <div class="col-sm-3">
                <label class="tipLabel">Tip:
                    <select name="tip" class="tipDropdown">
                        <option value="1" {{ old('tip') == 1 ? 'selected' : '' }}>No Tip</option>
                        <option value="1.10" {{ old('tip') == 1.10 ? 'selected' : '' }}>10% Tip</option>
                        <option value="1.15" {{ old('tip') == 1.15 ? 'selected' : '' }}>15% Tip</option>
                        <option value="1.20" {{ old('tip') == 1.20 ? 'selected' : '' }}>20% Tip</option>
                    </select>
                </label>
            </div>

            <div class="col-sm-3">
                <label>Round Up:
                    <input type="checkbox" name="roundUp" value="1" @if(old('roundUp')) checked @endif>
                </label>
            </div>
        </div>


        <input type="submit" value="Split It Girl!" class="splitButton" name="submit">
    </form>

    <br>


    <div class="standard"> @yield("result")
    </div>

</div>

<footer>
    <a href='https://github.com/mfaldas/p3'><i class='fa fa-github'></i> View on Github</a>
</footer>

</body>

</html>