# Project 3
+ By: Marc-Eli Faldas
+ Production URL: <http://p3.dwa15marcelifaldas.win>

## Outside Resources

**Images**

Background Image "_KatyPerry.jpg": <https://wallpaperscraft.com/download/katy_perry_table_girl_smile_brunette_85339/3840x2160#>

Katy Perry Logo "_KatyPerryLogo.png": <http://logonoid.com/katy-perry-logo/>

**Code References - Project 3**

Error Field Form PHP Code and CSS Code from Foobooks from Lecture: <https://github.com/susanBuck/foobooks/blob/392eff49ba15086fb4de12280814d4c20b48a478/resources/views/modules/error-field.blade.php>

```
@if($errors->get($field))
    <ul class='error'>
        @foreach($errors->get($field) as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

#validationError {

    padding-left: 50px;
    margin-top: 10px;

}
``` 

Error Field PHP Code and CSS Code from Foobooks from Lecture: <https://github.com/susanBuck/foobooks/blob/392eff49ba15086fb4de12280814d4c20b48a478/resources/views/modules/error-field.blade.php>

```
@if($errors->get($field))
    <ul class='error'>
        @foreach($errors->get($field) as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

.error {
    list-style-type: none;
    color: #a94442; /* reddish */
    text-align: left;
    padding-left: 50px;
    font-size: 1.2rem;
    font-size: 12px;
    font-style: italic;
}
```

How to Keep Old Values with Checkbox: <https://stackoverflow.com/questions/33141056/laravel-5-1-how-to-use-old-helper-on-blade-file-for-radio-inputs>

Code from StackOverflow:

```
<input type="radio" name="geckoHatchling" id="geckoHatchlingYes" value="1" @if(old('geckoHatchling')) checked @endif>

<input type="radio" name="geckoHatchling" id="geckoHatchlingYes" value="1" @if(!old('geckoHatchling')) checked @endif>
```

My Code:

```
old('roundUp', $roundUp)  ? 'checked' : ''
```

My Code does not use If/Else Statements but uses the Ternary Statement.

Keep the Old Option from a Dropdown: https://laracasts.com/discuss/channels/laravel/old-value-in-select-option

Code from Laracasts:

```
<select name="category_id">
    <option value="1"  {{ old('category_id') == 1 ? 'selected' : '' }}>
        Item 1
    </option>
    <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>
        Item 2
    </option>
    <option value="3" {{ old('category_id') == 3 ? 'selected' : '' }}>
        Item 3
    </option>
</select>
```

My Code:

```
<label class='tipLabel'>Tip:
    <select name='tip' class='tipDropdown'>
        <option value='1' {{ old('tip', $tip) == '1' ? 'selected' : '' }}>No Tip</option>
        <option value='1.10' {{ old('tip', $tip) == '1.10' ? 'selected' : ''}}>10% Tip</option>
        <option value='1.15' {{ old('tip', $tip) == '1.15' ? 'selected' : '' }}>15% Tip</option>
        <option value='1.20' {{ old('tip', $tip) == '1.20' ? 'selected' : '' }}>20% Tip</option>
    </select>
</label>
```

My Code presents all data from the previous session if a reload was done.


HTML Code for Footer from Foobooks from Lecture: <https://github.com/susanBuck/foobooks/blob/21b1f48a53d40b5c5b665aed3091409f317a3fc0/resources/views/layouts/master.blade.php>

```
<footer>
    <a href='http://github.com/susanBuck/foobooks'><i class='fa fa-github'></i> View on Github</a>
</footer>
```

Code to 'Put' data into a Session: https://laravel.com/docs/5.6/session

```
$request->session()->put('bill', $request->bill);
$request->session()->put('split', $request->split);
$request->session()->put('tip', $request->tip);
$request->session()->put('roundUp', $request->roundUp);

```

Also received help from Professor Susan Buck.

CSS Code for Footer from Foobooks from Lecture: <https://github.com/susanBuck/foobooks/blob/392eff49ba15086fb4de12280814d4c20b48a478/public/css/foobooks.css>

```
footer {
    text-align: center;
    background-color: #eee;

    /* sticky footer */
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 60px;
    line-height: 60px; /* Vertically center the text there */
    background-color: rgba(255, 255, 255, 0.5);
}
```

Used Bootstrap and Font Awesome for some CSS modifications.

**Code References - Project 2 Code integrated to Project 3**

Opacity Code for Parent Div: <https://stackoverflow.com/questions/3969380/achieving-white-opacity-effect-in-html-css>

```
background-color: rgba(255, 255, 255, 0.5);
```

Bill Splitter Algorithim Insipiration: <https://stackoverflow.com/questions/3918567/splitting-the-bill-algorithmically-fair-afterwards>

Code from Forum:

```
total_cents = 100 * total;
base_amount = Floor(total_cents / num_people);
cents_short = total_cents - base_amount * num_people;
while (cents_short > 0)
{
    // add one cent to a random person
    cents_short--;
}
```

My Code:
```
$s = $this->split;
$regularSplit = intval(($cS * 100)) / 100;
$calculatedTotal = $regularSplit * $s;

if ($b == $calculatedTotal) {
        $cSString = number_format((float)$cS, 2, ".", "");

        return [(string)$s, $cSString, "0", "0.00"];
    } else {
        $difference = $b - $calculatedTotal;
        $payExtra = round($difference / 0.01);  //How many people will pay extra 1 cent
        $payNormal = $s - $payExtra; //How many people will pay the normal payment
        $extraSplit = $regularSplit + 0.01;
```

The code from the Stack Overflow mostly served as a jumping off point of logic as opposed to a copy of the code.

## Code Style Divergences

Line 81 of index.blade.php has characters more than 180 characters as it is a description for the user.

```
<div class='standard' id='welcomeMessage'>
    Hi! I'm Katy Perry. You probably don't recognize me without my blue wig. When I'm not singing on tour, making music videos or brushing Nugget's cute curls, I split bills! It's definitely a fun hobby and a great way for me to practice my math skills. Make sure to fill in the above fields. If you don't want any change, just check the "Round Up" selection and I'll round your payment to the next whole dollar. Thanks!
</div>
```

## Notes for Instructor

Please note the following:
* Split value field only accepts int values from 1-100.
* Bill value field accepts ints and floats.  Acceptable float values include "0.01", "0.1", "1".
* Uses the SuperGlobal GET.
* Created a custom validation rule called MoneyFormat.php.  Can be found in app/Rules/MoneyFormat.php.
* Reloading the page shows data from previous form submission with the welcome message.
* Cookies are not killed from session.  So if a new tab is opened, data from the previous session is still shown.

