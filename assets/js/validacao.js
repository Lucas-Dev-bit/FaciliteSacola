function ValidarLogin(){
    
    if($("#email").val().trim() == ''){
        alert("Preenchero campo E-MAIL");
        $("#email").focus();
        return false;
    }
    if($("#senha").val().trim() == ''){
        alert("Preencher o campo SENHA");
        $("#senha").focus();
        return false;
    }

}
function ValidarMeusDados() {

    if ($("#nome").val().trim() == '') {
        alert("Preencher o campo NOME");
        $("#nome").focus();
        return false;
    }
    if ($("#email").val().trim() == '') {
        alert("Preencher o campo EMAIL");
        $("#email").focus();
        return false;
    }
}
function ValidarNovoCliente() {

    //Essa mesma função para a página ALTERAR CLIENTE. 

    if ($("#nome").val().trim() == '') {
        alert("Preencher o campo NOME DO CLIENTE");
        $("#nome").focus();
        return false;
    }
    if ($("#rua").val().trim() == '') {
        alert("Preencher o campo RUA");
        $("#rua").focus();
        return false;
    }
    if ($("#bairro").val().trim() == '') {
        alert("Preencher o campo BAIRRO");
        $("#bairro").focus();
        return false;
    }
    if ($("#tel").val().trim() == '') {
        alert("Preencher o campo TELEFONE");
        $("#tel").focus();
        return false;
    }
    if ($("#whats").val().trim() == '') {
        alert("Preencher o campo WHATSAPP");
        $("#whats").focus();
        return false;
    }
    if ($("#datanascimento").val().trim() == '') {
        alert("Preencher o campo DATA DE NASCIMENTO");
        $("#datanascimento").focus();
        return false;
    }
    if ($("#sexo").val().trim() == '') {
        alert("Preencher o campo SEXO");
        $("#sexo").focus();
        return false;
    }
}
function ValidarProduto() {

    if ($("#nome").val().trim() == '') {
        alert("Preencher o campo NOME DO PRODUTO");
        $("#nome").focus();
        return false;
    }
    if ($("#descricao").val().trim() == '') {
        alert("Preencher o campo DESCRIÇÃO");
        $("#descricao").focus();
        return false;
    }
    if ($("#codigo").val().trim() == '') {
        alert("Preencher o campo CÓDIGO");
        $("#codigo").focus();
        return false;
    }
    if ($("#tamanho").val().trim() == '') {
        alert("Preencher o campo TAMANHO");
        $("#tamanho").focus();
        return false;
    }
    if ($("#pcompra").val().trim() == '') {
        alert("Preencher o campo PREÇO COMPRA");
        $("#pcompra").focus();
        return false;
    }
    if ($("#pvenda").val().trim() == '') {
        alert("Preencher o campo PREÇO VENDA");
        $("#pvenda").focus();
        return false;
    }
}
function ValidarFazerSacola() {

    ////Essa mesma função para a página ALTERAR SACOLA. 

    if ($("#cliente").val().trim() == '') {
        alert("Preencher o campo SELECIONE O CLIENTE");
        $("#cliente").focus();
        return false;
    }

    if ($("#dataentrega").val().trim() == '') {
        alert("Preencher o campo DATA ENTREGA");
        $("#dataentrega").focus();
        return false;
    }
    if ($("#dataretirada").val().trim() == '') {
        alert("Preencher o campo DATA RETIRADA");
        $("#dataretirada").focus();
        return false;
    }
    if ($("#horaentrega").val().trim() == '') {
        alert("Preencher o campo HORA ENTREGA");
        $("#horaentrega").focus();
        return false;
    }
    if ($("#horaretirada").val().trim() == '') {
        alert("Preencher o campo HORA RETIRADA");
        $("#horaretirada").focus();
        return false;
    }
    if ($("#enderecoentrega").val().trim() == '') {
        alert("Preencher o campo ENDEREÇO DE ENTREGA");
        $("#enderecoentrega").focus();
        return false;
    }
    if ($("#enderecoretirada").val().trim() == '') {
        alert("Preencher o campo ENDEREÇO DE RETIRADA");
        $("#enderecoretirada").focus();
        return false;
    }

}
function ValidarConsultarSacola() {
    
    if ($("#inicial").val().trim() == '') {
        alert("Preencher o campo DATA INICIAL");
        $("#inicial").focus();
        return false;
    }
    if ($("#final").val().trim() == '') {
        alert("Preencher o campo DARA FINAL");
        $("#final").focus();
        return false;
    }

}
function ValidarAdicionarItem() {

    if ($("#produto").val().trim() == '') {
        alert("Preencher o campo PRODUTO");
        $("#produto").focus();
        return false;
    }

    if ($("#qtdproduto").val().trim() == '') {
        alert("Preencher o campo QUANTIDADE");
        $("#qtdproduto").focus();
        return false;
    }
    if ($("#valor").val().trim() == '') {
        alert("Preencher o campo VALOR");
        $("#valor").focus();
        return false;
    }
}
