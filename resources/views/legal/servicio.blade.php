@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Términos de servicio</div>

                <div class="panel-body">
                    Los precios y condiciones de venta tienen un carácter meramente informativo y pueden ser modificados en atención a las fluctuaciones del mercado. No obstante, la realización del pedido mediante la cumplimentación del formulario de compra, implica la conformidad con el precio ofertado y con las condiciones generales de venta vigentes en ese concreto momento. Una vez formalizado el pedido, se entenderá perfeccionada la compra de pleno derecho, con todas las garantías legales que amparan al consumidor adquirente y, desde ese instante, los precios y condiciones tendrán carácter contractual y no podrán ser modificados sin el expreso acuerdo de ambos contratantes. El castellano será la lengua utilizada para formalizar el contrato. El documento electrónico en que se formalice el contrato se archivará y el usuario tendrá acceso a él en su zona de cliente.</br>

                    <h3>Envíos</h3>
                    <ul>
                        <li>Los plazos de entrega oscilan entre las 24 y las 72 horas a elección del cliente. No podemos garantizar estos plazos de entrega, si bien intentamos que las empresas de transporte los cumplan siempre que sea posible. En poblaciones rurales alejadas de núcleos urbanos no es posible garantizar en ningún caso la entrega en 24 horas.</li>
                        <li>Los plazos de entrega dependerán de la disponibilidad de cada producto, la cual se encuentra indicada en todos y cada uno de los productos ofertados. En los pedidos que incluyan varios artículos se hará un único envío y el plazo de entrega se corresponderá con el artículo cuyo plazo de entrega sea mayor.</li>
                        <li>El cliente dispondrá de 72 horas para comprobar la integridad de todos los componentes del pedido y para comprobar que se incluye todo lo que debe en los productos incluidos. Pasadas estas 72 horas se dará por aceptado el envío y no se aceptarán reclamaciones por desperfectos o fallos con el envío.</li>
                        <li>Se considerará entregado un pedido cuando sea firmado el recibo de entrega por parte del cliente. Es en las próximas 24 horas cuando el cliente debe verificar los productos a la recepción de los mismos y exponer todas las objeciones que pudiesen existir.</li>
                        <li>En caso de recibir un producto dañado por el transporte es recomendable contactarnos dentro de las primeras 24 horas para poder reclamar la incidencia a la empresa de transporte. De la misma forma es conveniente dejar constancia a la empresa de transporte:</br>
                    </br>
                        <ul>
                            <li>Empresa de transporte 1: XXX XXX XXX</li>
                            <li>Empresa de transporte 2: XXX XXX XXX</li>
                        </ul>
                    </br>
                        <li>Puedes consultar todo lo relativo a gastos de envío haciendo click <a href="{{ url('/gastosenvio') }}">aquí</a>.</li>
                    </ul>
                    <h3>Devoluciones</h3>
                    Conforme a la legislación vigente, se puede proceder a la devolución de productos, por el motivo que sea, en un plazo de 30 días naturales desde la recepción de la mercancía por el cliente. Para ello se deben cumplir las condiciones expuestas en esta página de condiciones. El consumidor y usuario sólo será responsable de la disminución de valor de los bienes resultante de una manipulación de los mismos distinta a la necesaria para establecer su naturaleza, sus características o su funcionamiento.

                    <h3>Condiciones de devoluciones para clientes particulares</h3>

                    <ul>
                        <li>No se aceptarán devoluciones de los siguientes productos, tal y como establece el Real Decreto Legislativo 1/2007, de 16 de noviembre, por el que se aprueba el texto refundido de la Ley General para la Defensa de los Consumidores y Usuarios y otras leyes complementarias:</li>
                            <ol type="1">
                                <li>La prestación de servicios, una vez que el servicio haya sido completamente ejecutado, cuando la ejecución haya comenzado, con previo consentimiento expreso del consumidor y usuario y con el reconocimiento por su parte de que es consciente de que, una vez que el contrato haya sido completamente ejecutado por el empresario, habrá perdido su derecho de desistimiento.</li>
                                <li>El suministro de bienes o la prestación de servicios cuyo precio dependa de fluctuaciones del mercado financiero que el empresario no pueda controlar y que puedan producirse durante el periodo de desistimiento.</li>
                                <li>El suministro de bienes confeccionados conforme a las especificaciones del consumidor y usuario o claramente personalizados, como los ordenadores configurados a la carta.</li>
                                <li>El suministro de bienes que puedan deteriorarse o caducar con rapidez.</li>
                                <li>El suministro de bienes precintados que no sean aptos para ser devueltos por razones de protección de la salud o de higiene y que hayan sido desprecintados tras la entrega (p. ej. productos y robots de cocina y similares).</li>
                                <li>El suministro de bienes que después de su entrega y teniendo en cuenta su naturaleza se hayan mezclado de forma indisociable con otros bienes.</li>
                                <li>El suministro de grabaciones sonoras o de vídeo precintadas o de programas informáticos precintados que hayan sido desprecintados por el consumidor y usuario después de la entrega.</li>
                                <li>El suministro de contenido digital que no se preste en un soporte material cuando la ejecución haya comenzado con el previo consentimiento expreso del consumidor y usuario con el conocimiento por su parte de que en consecuencia pierde su derecho de desistimiento.</li>
                            </ol>
                        <li>Toda mercancía debe ser devuelta en su embalaje y condiciones originales, en perfecto estado y protegida, evitando pegatinas, precintos o cintas adhesivas directamente sobre la superficie o embalaje del artículo. En caso contrario DISCOSONLINE se reserva el derecho de rechazar la devolución.</li>
                        <li>Una vez rellenado y enviado el formulario de devolución, recibirás las instrucciones para que nos lo hagas llegar a nuestras instalaciones en tu correo electrónico. Deberás enviar los bienes sin ninguna demora, en un plazo máximo de 30 días desde que nos comuniques tu deseo de ejercer el derecho.</li>
                        <li>Los gastos de transporte originados por la devolución correrán a tu cargo. Tú eres libre de elegir y buscar la agencia que más se adapte a tus necesidades o te ofrezca las tarifas más competitivas.</li>

                        <li>Una vez recibida la mercancía y comprobada que está en perfectas condiciones, se tramitará la devolución del importe. Te devolveremos el pago recibido, incluido el gasto de entrega con la excepción de los gastos adicionales resultantes de la elección por tu parte de una modalidad de entrega diferente a la modalidad menos costosa de entrega ordinaria que ofrezcamos. Te realizaremos el abono en un plazo máximo de 30 días naturales desde que ejerzas tu derecho de desistimiento. Hasta que no hayamos recibido los bienes podremos retener el reembolso.</li>
                        <li>Devolución de productos con regalo o promoción. Será obligatorio la devolución completa (pack completo o artículo + regalo) para poder proceder al reembolso. En el caso de productos que incluyen códigos de descarga de juegos será requisito no haberlo descargado para proceder al abono completo. En el caso de que se haya descargado se descontará el importe del juego al total a reembolsar.</li>
                    </ul>

                    <h3>Condiciones de devoluciones para distribuidores</h3>

                    Únicamente se aceptarán devoluciones de material sin desprecintar y en perfecto estado, durante los 30 días naturales posteriores a su recepción.
                    Las promociones existentes en la web que extiendan el plazo de entrega de 30 días no serán aplicables a distribuidores, que tendrán siempre un plazo de devolución de 30 días.
                    Tales devoluciones serán tramitadas como devolución comercial, ya que no hay ninguna ley que regule los derechos de devolución entre empresas, y dichas tramitaciones están reguladas según las condiciones de DISCOSONLINE.

                    <h3>Cancelaciones de pedidos</h3>
                    Aquellas cancelaciones de pedidos que impliquen una devolución al cliente y que sean por transferencia bancaria tendrán un plazo máximo de 30 días por trámites administrativos, si bien intentamos que el plazo no sea superior a 7 días.

                    <h3>Resolución de litigios</h3>
                    Resolución de litigios en línea en materia de consumo conforme al Art. 14.1 del Reglamento (UE) 524/2013: La Comisión Europea facilita una plataforma de resolución de litigios en línea que se encuentra disponible en el siguiente enlace: <a href="http://ec.europa.eu/consumers/odr/">http://ec.europa.eu/consumers/odr/</a>.

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
