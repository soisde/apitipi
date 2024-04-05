<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cep</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>


<body>

    <h1>cep</h1>

    <label for="cep">CEP</label>
    <input type="text" id="cep" name="cep">
    <button onclick="buscarCep()">Buscar Cep</button>

    <div id="endereco">
        <h2>cep: </h2>
        <h2>logradouro: </h2>
        <h2>complemento: </h2>
        <h2>bairro: </h2>
        <h2>localidade:</h2>
        <h2>uf: </h2>
        <h2>ddd: </h2>
    </div>


    <script>
        function buscarCep() {
            var cep = $('#cep').val();

            $.get('https://viacep.com.br/ws/' + cep + '/json/', function(data) {

                $('#endereco').html('');

                $('#endereco').append('<h2>Dados de endereço<h2>')

                $('#endereco').append('<h2>cep:' + data.cep + '<h2>')

                $('#endereco').append('<h2>logradouro:' + data.logradouro + '<h2>')

                $('#endereco').append('<h2>complemento:' + data.complemento + '<h2>')

                $('#endereco').append('<h2>bairro:' + data.bairro + '<h2>')

                $('#endereco').append('<h2>localidade:' + data.localidade + '<h2>')

                $('#endereco').append('<h2>uf:' + data.uf + '<h2>')

                $('#endereco').append('<h2>ddd:' + data.ddd + '<h2>')
            })

        }
    </script>


</body>

</html>
