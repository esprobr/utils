<?php
namespace Espro\Utils;

use Symfony\Component\HttpFoundation\Response;

class Url
{
    /**
     * Verifica se uma url é válida. Quando encontra redirecionamentos, verifica até chegar no ultimo domínio
     * @param string $_url
     * @param int $_timeOut
     * @return ModelResult
     */
    public static function exists( $_url, $_timeOut = 5 )
    {
        if(!isset(Response::$statusTexts[-1])) {
            Response::$statusTexts[-1] = "Invalid url";
        }
        if(!isset(Response::$statusTexts[0])) {
            Response::$statusTexts[0] = "URL not found";
        }

        $result = new ModelResult(
            false,
            Response::$statusTexts[-1]
        );

        $url = trim( $_url,'/' ) . '/';

        if( !is_null( $url ) && !empty( $url ) ) {
            $ch = curl_init( $url );
            curl_setopt( $ch, CURLOPT_TIMEOUT, $_timeOut );
            curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $_timeOut );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_exec( $ch );
            $httpInfo = curl_getinfo( $ch );
            curl_close( $ch );

            $result->setMessage( Response::$statusTexts[$httpInfo['http_code']] );
            $result->setResult( $httpInfo['http_code'] );
            if( intval( $httpInfo['http_code'] ) == Response::HTTP_OK ) {
                $result->setStatus(true);
            } elseif( in_array( $httpInfo['http_code'], [ Response::HTTP_MOVED_PERMANENTLY, Response::HTTP_FOUND ] ) ) {
                $result = self::exists( $httpInfo['redirect_url'], $_timeOut );
            }
        }

        return $result;
    }

    public static function translateMessagesToPT_BR()
    {
        Response::$statusTexts = [
            Response::HTTP_CONTINUE => 'Continue',
            Response::HTTP_SWITCHING_PROTOCOLS => 'Trocando de Protocolo',
            Response::HTTP_PROCESSING => 'Processando',
            Response::HTTP_EARLY_HINTS => 'Early Hints',
            Response::HTTP_OK => 'Ok',
            Response::HTTP_CREATED => 'Criado',
            Response::HTTP_ACCEPTED => 'Aceito',
            Response::HTTP_NON_AUTHORITATIVE_INFORMATION => 'Informação não autoritativa',
            Response::HTTP_NO_CONTENT => 'Requisição obteve retorno sem conteúdo',
            Response::HTTP_RESET_CONTENT => 'Recarregar página',
            Response::HTTP_PARTIAL_CONTENT => 'Conteúdo parcial',
            Response::HTTP_MULTI_STATUS => 'Multi Status',
            Response::HTTP_ALREADY_REPORTED => 'Já reportado',
            Response::HTTP_IM_USED => 'Utilizado',
            Response::HTTP_MULTIPLE_CHOICES => 'Múltiplas escolhas',
            Response::HTTP_MOVED_PERMANENTLY => 'Movido permanentemente',
            Response::HTTP_FOUND => 'Encontrado',
            Response::HTTP_SEE_OTHER => 'Verificar outro endereço',
            Response::HTTP_NOT_MODIFIED => 'Não modificado',
            Response::HTTP_USE_PROXY => 'Use proxy',
            Response::HTTP_RESERVED => 'Reservado',
            Response::HTTP_TEMPORARY_REDIRECT => 'Redirecionado temporariamente',
            Response::HTTP_PERMANENTLY_REDIRECT => 'Redirecionado permanentemente',
            Response::HTTP_BAD_REQUEST => 'Requisição inválida',
            Response::HTTP_UNAUTHORIZED => 'Não autorizado',
            Response::HTTP_PAYMENT_REQUIRED => 'Necessário Pagamento',
            Response::HTTP_FORBIDDEN => 'Proibído',
            Response::HTTP_NOT_FOUND => 'Página não encontrada',
            Response::HTTP_METHOD_NOT_ALLOWED => 'Requisição não permitida',
            Response::HTTP_NOT_ACCEPTABLE => 'Não aceito',
            Response::HTTP_PROXY_AUTHENTICATION_REQUIRED => 'Necessário utilizar proxy',
            Response::HTTP_REQUEST_TIMEOUT => 'Request timeout',
            Response::HTTP_CONFLICT => 'Conflito',
            Response::HTTP_GONE => 'Gone',
            Response::HTTP_LENGTH_REQUIRED => 'Necessário comprimento',
            Response::HTTP_PRECONDITION_FAILED => 'Precondition Failed',
            Response::HTTP_REQUEST_ENTITY_TOO_LARGE => 'Entidade da requisição excedeu o limite',
            Response::HTTP_REQUEST_URI_TOO_LONG => 'URI da requisição muito longa',
            Response::HTTP_UNSUPPORTED_MEDIA_TYPE => 'Tipo de mídia não é suportado',
            Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE => 'Intervalo solicitado não pode ser satisfeito',
            Response::HTTP_EXPECTATION_FAILED => 'Expectativa falhou',
            Response::HTTP_I_AM_A_TEAPOT => 'I\'m a teapot',
            Response::HTTP_MISDIRECTED_REQUEST => 'Requisição mal direcionada',
            Response::HTTP_UNPROCESSABLE_ENTITY => 'Entidade não é processável',
            Response::HTTP_LOCKED => 'Trancado',
            Response::HTTP_FAILED_DEPENDENCY => 'Dependência falhou',
            Response::HTTP_TOO_EARLY => 'Muito cedo',
            Response::HTTP_UPGRADE_REQUIRED => 'Upgrade Required',
            Response::HTTP_PRECONDITION_REQUIRED => 'Precondition Required',
            Response::HTTP_TOO_MANY_REQUESTS => 'Too Many Requests',
            Response::HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE => 'Request Header Fields Too Large',
            Response::HTTP_UNAVAILABLE_FOR_LEGAL_REASONS => 'Indisponível por razões legais',
            Response::HTTP_INTERNAL_SERVER_ERROR => 'Erro interno do servidor',
            Response::HTTP_NOT_IMPLEMENTED => 'Não implementado',
            Response::HTTP_BAD_GATEWAY => 'Gateway Ruim',
            Response::HTTP_SERVICE_UNAVAILABLE => 'Serviço não disponível',
            Response::HTTP_GATEWAY_TIMEOUT => 'Gateway Timeout',
            Response::HTTP_VERSION_NOT_SUPPORTED => 'Versão HTTP não suportada',
            Response::HTTP_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL => 'Variant Also Negotiates',
            Response::HTTP_INSUFFICIENT_STORAGE => 'Armazenamento insuficiente',
            Response::HTTP_LOOP_DETECTED => 'Loop Detectado',
            Response::HTTP_NOT_EXTENDED => 'Não extendido',
            Response::HTTP_NETWORK_AUTHENTICATION_REQUIRED => 'Necessita autenticação de rede',
            0	=> 'O endereço informado não foi encontrado',
            -1	=> 'Url não informada'
        ];
    }
}