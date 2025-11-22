$( document ).ready(function()
{
    /**
     * Abrir caixa informar CEP quando houver
     * um click no botão informar cep.
     */
    $(".informar-cep .btn").click(function()
    {
        $(".informar-cep-box").css("display", "block");
    });

    /**
     * Fechar caixa informar CEP quando houver
     * um click no botão informar cep.
     */
    $(".informar-cep-box .button-close").click(function()
    {
        $(".informar-cep-box").css("display", "none");
    });

    /**
     * Abrir sidebar mobile quando houver
     * um click em bars.
     */
    $(".navbar-mobile .bars").click(function()
    {
        $(".sidebar-mobile").css("display", "block");
    });

    /**
     * Fechar a sidebar mobile quando houver
     * um click.
     */
    $(".sidebar-mobile .close .btn").click(function()
    {
        $(".sidebar-mobile").css("display", "none");
    });

    /**
     * Abrir campo de busca em dispositivos
     * mobile.
     */
    $(".btn-search").click(function()
    {
        $(".search-mobile").css("display", "block");
    });

    /**
     * Fechar campo de busca em dispositivos
     * mobile.
     */
    $(".btn-search-close").click(function()
    {
        $(".search-mobile").css("display", "none");
    });
});
