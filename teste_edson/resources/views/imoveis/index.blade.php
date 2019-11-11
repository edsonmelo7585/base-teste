@extends('layouts.app', ["current_page" => "Imóveis"])
@section('body')
<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Imóveis</h5>
        <table class="table table-ordered table-hover" id="tabelaImoveis">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onClick="novoImovel()">Novo Imovel</a>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="dlgImoveis">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formImovel">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Imóvel</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control">
                    <input type="hidden" id="idendereco" class="form-control">
                    <div class="form-group">
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="descricao" class="control-label">Descrição do Imóvel</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="descricao" placeholder="Descrição do Imóvel">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="proprietario">Proprietário</label>
                                <select class="custom-select d-block w-100" id="proprietario" required>
                                    <option value="">Escolha...</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, insira um Proprietário válido.
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label for="endereco">Endereço</label>
                                        <input type="text" class="form-control" id="endereco" placeholder="Rua feliciano sodré" required>
                                        <div class="invalid-feedback">
                                        Por favor, insira seu endereço de entrega.
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="numero" class="control-label">Número</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="numero" placeholder="Número">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="bairro" class="control-label">Bairro</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="bairro" placeholder="Bairro">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="estado">Estado</label>
                                        <select class="custom-select d-block w-100" id="estado" required>
                                            <option value="">Escolha...</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor, insira um estado válido.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cidade">Cidade</label>
                                        <select class="custom-select d-block w-100" id="cidade" required>
                                            <option value="">Escolha...</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor, insira um cidade válido.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="cep">CEP</label>
                                <input type="text" class="form-control" id="cep" placeholder="" required>
                                <div class="invalid-feedback">
                                É obrigatório inserir um CEP.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="tipoImovel">Tipo do Imóvel</label>
                                <select class="custom-select d-block w-100" id="tipoImovel" required>
                                    <option value="">Escolha...</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, insira um Tipo do Imóvel válido.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
    })
    function novoImovel() {
        $('#id').val('');
        $('#idendereco').val('');
        $('#descricao').val('');
        $('#endereco').val('');
        $('#numero').val('');
        $('#estado').val('');
        $('#proprietario').val('');
        $('#cidade').val('');
        $('#bairro').val('');
        $('#tipoImovel').val('');
        // $('#dlgImoveis').modal('show');
        $('#dlgImoveis').show();
    }
    // function buscarImovel(id){
    //     var nome = '';
    //     $.getJSON('/api/imoveiss', function(data) {
    //         for(i=0;i<data.length;i++) {
    //             nome = data[i].nome;
    //         }
    //     });
    //     return nome;
    // }

    function montarLinha(c) {
        var linha = "<tr>" +
            "<td>" + c.id + "</td>" +
            "<td>" + c.descricao + "</td>" +
            "<td>" +
              '<button class="btn btn-sm btn-primary" onclick="editar(' + c.id + ')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onclick="remover(' + c.id + ')"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function editar(id) {
        $.getJSON('/api/imoveis/'+id, function(data) {
            // var endereco = data.immobiles_addresses[0];
            console.log(data[0]);
            $('#id').val(data[0].id);
            $('#descricao').val(data[0].descricao);
            $('#endereco').val(data[0].immobiles_addresses.logradouro);
            $('#numero').val(data[0].immobiles_addresses.numero);
            $('#bairro').val(data[0].immobiles_addresses.bairro);
            $('#cidade').val(data[0].immobiles_addresses.city_id);
            $('#estado').val(data[0].immobiles_addresses.state_id);
            $('#cep').val(data[0].immobiles_addresses.cep);
            $('#tipoImovel').val(data[0].immobiles_type_id);
            $('#proprietario').val(data[0].owner_id);
            $('#dlgImoveis').show();
        });
    }

    function remover(id) {
        $.ajax({
            type: "DELETE",
            url: "/api/imoveis/" + id,
            context: this,
            success: function() {
                console.log('Apagou OK');
                linhas = $("#tabelaImoveis>tbody>tr");
                e = linhas.filter( function(i, elemento) {
                    return elemento.cells[0].textContent == id;
                });
                if (e)
                    e.remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function carregarImoveis() {
        $.getJSON('/api/imoveis', function(Imoveis) {
            for(i=0;i<Imoveis.length;i++) {
                linha = montarLinha(Imoveis[i]);
                $('#tabelaImoveis>tbody').append(linha);
            }
        });
    }
    function montarOptions(id, descricao) {
        var linha = "<option value='"+id+"'>"+descricao+"</option>";
        return linha;
    }

    function carregarproprietarios() {
        $.getJSON('/api/proprietarios', function(proprietarios) {
            for(i=0;i<proprietarios.length;i++) {
                linha = montarOptions(proprietarios[i].id, proprietarios[i].nome);
                $('#proprietario').append(linha);
            }
        });
    }
    function carregarEstados() {
        $.getJSON('/api/estados', function(estados) {
            for(i=0;i<estados.length;i++) {
                linha = montarOptions(estados[i].id, estados[i].nome);
                $('#estado').append(linha);
            }
        });
    }
    function carregarCidades() {
        $.getJSON('/api/cidades', function(cidades) {
            for(i=0;i<cidades.length;i++) {
                linha = montarOptions(cidades[i].id, cidades[i].nome);
                $('#cidade').append(linha);
            }
        });
    }
    function carregartipoImovel() {
        $.getJSON('/api/tiposImovel', function(tipos) {
            for(i=0;i<tipos.length;i++) {
                linha = montarOptions(tipos[i].id, tipos[i].descricao);
                $('#tipoImovel').append(linha);
            }
        });
    }
    function criarImovel() {
        imovel = {
            descricao: $("#descricao").val(),
            owner_id: $("#proprietario").val(),
            immobiles_type_id: $("#tipoImovel").val(),
            immobiles_addresses: {
                logradouro: $("#endereco").val(),
                numero: $("#numero").val(),
                bairro: $("#bairro").val(),
                cep: $("#cep").val(),
                city_id: $("#cidade").val(),
                state_id: $("#estado").val()
            }
        };
        $.post("/api/imoveis", imovel, function(data) {
            console.log(data);
            imovel = JSON.parse(data);
            linha = montarLinha(imovel);
            $('#tabelaImoveis>tbody').append(linha);
        });
    }
    function salvarImovel() {
        imovel = {
            id : $("#id").val(),
            descricao: $("#descricao").val(),
            owner_id: $("#proprietario").val(),
            immobiles_type_id: $("#tipoImovel").val(),
            immobiles_addresses: {
                id: $("#idendereco").val(),
                logradouro: $("#endereco").val(),
                numero: $("#numero").val(),
                bairro: $("#bairro").val(),
                cep: $("#cep").val(),
                city_id: $("#cidade").val(),
                state_id: $("#estado").val()
            }
        };
        $.ajax({
            type: "PUT",
            url: "/api/imoveis/" + imovel.id,
            context: this,
            data: imovel,
            success: function(data) {
                imovel = JSON.parse(data);
                linhas = $("#tabelaImoveis>tbody>tr");
                e = linhas.filter( function(i, e) {
                    return ( e.cells[0].textContent == imovel.id );
                });
                if (e) {
                    e[0].cells[0].textContent = imovel.id;
                    e[0].cells[1].textContent = imovel.nome;
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    $("#formImovel").submit( function(event){
        event.preventDefault();
        if ($("#id").val() != '')
            salvarImovel();
        else
            criarImovel();

        $("#dlgImoveis").hide();
    });

    $(function(){
        carregarImoveis();
        carregarproprietarios();
        carregarEstados();
        carregarCidades();
        carregartipoImovel();
    })
</script>
@endsection
