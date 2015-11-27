<html>
<head>
    <title>Kudos - PHP test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script type="application/javascript">
    $(function(){
        $('form#parse').submit(function(event){
            event.preventDefault();

            $.post( '/?a=parse',
                {
                    'url': $('form#parse #url').val(),
                    'item': $('form#parse #item').val()
                },
                function( data ) {
                    if (data.status == 1) {
                        $('#result').html(data.item);
                        $('#result_html').html(data.item_html);
                    } else {
                        $('#result').html(data.error);
                    }
            }, 'json');
        });
    });

    </script>
</head>
<body>
<form id="parse">
    <label for="url">URL</label>
    <input name="url" id="url" />

    <br />
    <label for="item">Item</label>
    <input name="item" id="item" />

    <br />
    <input type="submit" value="Submit" />
</form>

<div id="result"></div>
<pre id="result_html"></pre>

</body>
</html>