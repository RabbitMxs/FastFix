INSERT INTO `tipousuario` (`idTipo`, `nombre`) VALUES (NULL, 'admin'), (NULL, 'user');


INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellidoM`, `apellidoP`, `genero`, `email`, `clave`, `foto`, `idTipoUsuario`) 
 VALUES (NULL, 'Maricarmen', 'Mendoza', 'Herrera', 'F', 'maricarmen@gmail.com', PASSWORD('12345'), NULL, '1'), 
		(NULL, 'Jorge', 'Patiño', 'Garcia', 'M', 'jorge@gmail.com', PASSWORD('12345'), NULL, '1'), 
		(NULL, 'Francisco', 'Morales', 'Rico', 'M', 'francisco@gmail.com', PASSWORD('12345'), NULL, '2'), 
		(NULL, 'Fernando', 'Gonzalez', 'Monroy', 'M', 'jorge_epg@outlook.com', PASSWORD('12345'), NULL, '2') ;


INSERT INTO `tipocomponente` (`id`, `nombre`)
  VALUES (NULL, 'Procesadores'), 
		 (NULL, 'Tarjetas Madre'), 
		 (NULL, 'Tarjetas de video '),
		 (NULL, 'Gabinetes'), 
		 (NULL, 'Fuentes de poder'), 
		 (NULL, 'Enfriamiento'), 
		 (NULL, 'Discos duros'), 
		 (NULL, 'Memoria RAM y Flash'), 
		 (NULL, 'Monitores'), 
		 (NULL, 'Unidades de disco');


INSERT INTO `proveedor` (`id`, `nombre`, `apellidoM`, `apellidoP`, `direccion`) 
 VALUES (NULL, 'Juan Pablo ', 'Ruiz', 'Perez', 'calle constitucion de 1910,Cortazar,GTO.'),
        (NULL, 'Raul ', 'Vargas ', 'Ortiz', 'calle Revolucion, Celaya,GTO.'), 
        (NULL, 'Alberto', 'Gomez', 'Rojas ', 'Av. Constituyentes, Celaya, GTO.');


ALTER TABLE `componente` CHANGE `nombre` `nombre` CHAR(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL; 

INSERT INTO `componente` (`id`, `nombre`, `caracteristicas`, `costo`, `idProveedor`, `idTipoComponente`) 
VALUES (NULL, 'Procesador Intel Core i5-10400F', 'Familia de procesador: Intel Core i5-10xxx ,Modelo del procesador i5-10400F, Socket de procesador LGA 1200, Número de núcleos 6\r\n\r\n', '3519.00', '1', '1'), 
       (NULL, 'Procesador AMD Ryzen 3', 'Familia de procesador AMD Ryzen 3,Modelo del procesador 3200G,Frecuencia del procesador 3.6 GHz, Socket de procesador Socket AM4 ,Número de núcleos 4\r\n\r\n', '2209.00', '1', '1'),
       (NULL, 'Procesador AMD Ryzen 7 ', 'Familia de procesador: AMD Ryzen 7\r\nModelo del procesador: 3700X\r\nFrecuencia del procesador: 3.6 GHz\r\nSocket de procesador: Socket AM4\r\nNúmero de núcleos: 8\r\n\r\n', '7569.00', '1', '1'), 
       (NULL, 'Procesador Intel Core ', 'Modelo del procesador: i5-9400F\r\nFrecuencia del procesador: 2,9 GHz\r\nSocket de procesador: LGA1151\r\nNúmero de núcleos: 6\r\n\r\n', '2929.00', '1', '1'),
       (NULL, 'Procesador AMD Athlon ', 'Familia de procesador: AMD Athlon\r\nModelo del procesador: 3000G\r\nFrecuencia del procesador: 3.5 GHz\r\nSocket de procesador: Socket AM4\r\nNúmero de núcleos: 2\r\n\r\n', '1189.00', '1', '1'), 
       (NULL, 'Procesador Intel Core ', 'Modelo del procesador: i9-9900K\r\nFrecuencia del procesador: 3,6 GHz\r\nSocket de procesador: LGA1151\r\nNúmero de núcleos: 8\r\n\r\n', '9179.00', '1', '1'),
       (NULL, 'Tarjeta Madre Gigabyte Micro ATX', 'Familia de procesador: AMD\r\nCircuito integrado de tarjeta madre: AMD B450\r\nSocket de procesador: Socket AM4\r\nMemoria interna, máximo: 32 GB\r\nTipo de memoria: DDR4-SDRAM\r\n\r\n', '1469.00', '2', '2'), 
       (NULL, 'Tarjeta Madre ASRock Micro ATX', 'Familia de procesador: AMD\r\nCircuito integrado de tarjeta madre: AMD B450\r\nSocket de procesador: Socket AM4\r\nMemoria interna, máximo: 64 GB\r\nTipo de memoria: DDR4-SDRAM\r\n\r\n', '2059.00', '2', '2'), 
       (NULL, 'Tarjeta madre ASUS micro ATX', 'Familia de procesador: AMD\r\nCircuito integrado de tarjeta madre: AMD A320\r\nSocket de procesador: Socket AM4\r\nMemoria interna, máximo: 32 GB\r\nTipo de memoria: DDR4-SDRAM\r\n\r\n', '1229.00', '2', '2'), 
       (NULL, 'Tarjeta Madre AORUS B450', 'Familia de procesador: AMD\r\nCircuito integrado de tarjeta madre: AMD B450\r\nSocket de procesador: Socket AM4\r\nMemoria interna, máximo: 64 GB\r\nTipo de memoria: DDR4 DIMM\r\n\r\n', '3039', NULL, '2'),
       (NULL, 'Tarjeta de Video Gigabyte AMD Radeon RX 5500', 'Gráficos discretos memoria del adaptador: 4 GB\r\nAncho de datos: 128 bit, Tipo de memoria: GDDR6\r\nFrecuencia del procesador: 1647 MHz\r\nFrecuencia Boost: 1845 MHz\r\nTipo de interfaz: PCI Express x16 4.0\r\nHDMI: 1x, DVI-I: 0x, DisplayPort: 3x\r\n\r\n', '4939.00', '3', '3'),
       (NULL, 'Tarjeta de video Gigabyte NVIDIA GeForce GTX 1050', 'Gráficos discretos memoria del adaptador: 4 GB\r\nAncho de datos: 128 bit, Tipo de memoria: GDDR5\r\nFrecuencia del procesador: 1290 MHz\r\nFrecuencia Boost: 1392 MHz\r\nNúcleos CUDA: 768\r\nTipo de interfaz: PCI Express x16 3.0\r\nHDMI: 1x, DVI-I: 0x, DisplayPort: 1x\r\n\r\n', '3529.00', '3', '3'), 
       (NULL, 'Tarjeta de video Gigabyte NVIDIA GeForce GTX 1650', 'Gráficos discretos memoria del adaptador: 4 GB\r\nAncho de datos: 128 bit, Tipo de memoria: GDDR5\r\nFrecuencia del procesador: 1710 MHz\r\nNúcleos CUDA: 896\r\nTipo de interfaz: PCI Express x16 3.0\r\nHDMI: 2x, DVI-I: 0x, DisplayPort: 1x\r\n\r\n', '5929.00', '3', '3'), 
       (NULL, 'Tarjeta de video Gigabyte NVIDIA GeForce GTX 1030', 'Gráficos discretos memoria del adaptador: 2 GB\r\nAncho de datos: 64 bit, Tipo de memoria: GDDR5\r\nFrecuencia del procesador: 1257 MHz\r\nFrecuencia Boost: 1506 MHz\r\nTipo de interfaz: PCI Express x16 3.0\r\nHDMI: 1x, DVI-I: 0x\r\n\r\n', '1859.00', '3', '3'), 
       (NULL, 'Tarjeta de Video Asus NVIDIA GeForce GTX 1050', 'Gráficos discretos memoria del adaptador: 4 GB\r\nAncho de datos: 128 bit, Tipo de memoria: GDDR5\r\nFrecuencia del procesador: 1290 MHz\r\nFrecuencia Boost: 1392 MHz\r\nNúcleos CUDA: 768\r\nTipo de interfaz: PCI Express 3.0\r\nHDMI: 1x, DVI-I: 0x, DisplayPort: 1x\r\n\r\n', '3159.00', '3', '3'),
       (NULL, 'Gabinete Corsair Carbide SPEC-05', 'Factor de forma: Midi-Tower\r\nTarjetas madre soportadas: ATX\r\nPuertos USB 2.0: 1, Puertos USB 3.0: 1\r\nFuente de alimentación incluida: No\r\nVentiladores frontales instalados: 1x 120 mm\r\n\r\n', '1139.00', '2', '4'), 
       (NULL, 'Gabinete Acteck Fusion X RGB', 'Tarjetas madre soportadas: Micro ATX\r\nPuertos USB 2.0: 1, Puertos USB 3.0: 1\r\nFuente de alimentación incluida: Sí\r\nFuente de alimentación: 500 W', '679', '2', '4'), 
       (NULL, 'Gabinete Corsair SPEC-DELTA RGB', 'Factor de forma: Midi-Tower\r\nTarjetas madre soportadas: ATX\r\nFuente de alimentación incluida: NO', '1469.00', '2', '4'),
       (NULL, 'Gabinete Yeyian Shadow  2200', 'Factor de forma: Torre\r\nTarjetas madre soportadas: ATX\r\nPuertos USB 2.0: 2\r\nFuente de alimentación incluida: No\r\nVentiladores frontales instalados: 3x 120 mm\r\n\r\n', '1499.00', '1', '4'), 
       (NULL, 'Gabinete Ateck AC-929035', 'Factor de forma: Midi-Tower\r\nTarjetas madre soportadas: Micro ATX,Mini-ITX\r\nPuertos USB 2.0: 1, Puertos USB 3.0: 0\r\nFuente de alimentación incluida: Sí\r\nFuente de alimentación: 500 W\r\n\r\n', '499.00', '1', '4'),
       (NULL, 'Fuente de Poder EVGA 0600K1 80 PLUS', '\r\n\r\nPotencia nominal: 600 W\r\nDiámetro de ventilador: 12 cm\r\nFactor de forma: ATX\r\nAlimentador de energía: 24-pin ATX\r\nNúmero de conectores SATA: 6\r\nCertificación 80 PLUS: 80 PLUS Bronze\r\n\r\n', '1399.00', '2', '5'), 
       (NULL, 'Fuente  de Poder Yeyian Raiden 80 PLUS', 'Potencia nominal: 850 W\r\nDiámetro de ventilador: 12 cm\r\nFactor de forma: ATX\r\nNúmero de conectores SATA: 9\r\nCertificación 80 PLUS: 80 PLUS Gold\r\n\r\n', '2119.00', '2', '5'), 
       (NULL, 'Fuente de Poder EVGA 100-N10750-LA', 'Potencia nominal: 750 W\r\nDiámetro de ventilador: 12 cm\r\nFactor de forma: ATX\r\nAlimentador de energía: 24-pin ATX\r\nNúmero de conectores SATA: 9\r\n\r\n', '1389', '2', '5'), 
       (NULL, 'Fuente de Poder Aerocool Cylon 700 80 PLUS', 'Potencia nominal: 700 W\r\nFactor de forma: ATX\r\nAlimentador de energía: 24-pin ATX\r\nNúmero de conectores SATA: 5\r\nCertificación 80 PLUS: 80 PLUS Bronze\r\n\r\n', '1309.00', '3', '5'), 
       (NULL, 'Fuente de Poder Gigabyte P550B 80 PLUS', 'Potencia nominal: 550 W\r\nDiámetro de ventilador: 12 cm\r\nFactor de forma: ATX\r\nAlimentador de energía: 24-pin ATX\r\nNúmero de conectores SATA: 6\r\nCertificación 80 PLUS: 80 PLUS Bronze\r\n\r\n', '1229.00', '2', '5'),
       (NULL, 'Ventilador Cooler Master R4-C2R-20AC-GP', 'Nivel de ruido: 19 dB\r\nVelocidad de rotación: 2000 RPM\r\n\r\n', '238', '1', '6'), 
       (NULL, 'Ventilador In Win Jupiter AJ120 RGB', 'Diámetro de ventilador: 12 cm', '779.00', '1', '6'), 
       (NULL, 'Ventilador Cooler Master MasterFan MF120 Halo', 'Nivel de ruido: 30 dB\r\nDiámetro de ventilador: 12 cm\r\nIluminación de color: Multi\r\n\r\n', '549.00', '1', '6'), 
       (NULL, 'Ventilador XPG Vento 120 ARGB LED', 'Diámetro de ventilador: 12 cm', '303.00', '1', '6'),
       (NULL, 'Memoria RAM HyperX FURY lack DDR4', 'Tipo de memoria interna: DDR4\r\nMemoria interna: 8 GB\r\nDiseño de memoria: 1 x 8 GB\r\nVelocidad de memoria del reloj: 2666 MHz\r\nLatencia CAS: 16\r\nFactor de Forma: 288-pin DIMM\r\n', '689.00', '2', '8'),
       (NULL, 'Memoria RAM XPG SPECTRIX D60G DDR4', 'Tipo de memoria interna: DDR4\r\nMemoria interna: 8 GB\r\nDiseño de memoria: 1 x 8 GB\r\nVelocidad de memoria del reloj: 3200 MHz\r\nLatencia CAS: 16\r\nFactor de Forma: 288-pin DIMM\r\n', '809.00', '2', '8'), 
       (NULL, 'Memoria RAM XPG GAMMIX D10 red DDR4', 'Tipo de memoria interna: DDR4\r\nMemoria interna: 8 GB\r\nDiseño de memoria: 1 x 8 GB\r\nVelocidad de memoria del reloj: 2666 MHz\r\nLatencia CAS: 16\r\nFactor de Forma: 288-pin DIMM\r\n', '649.00', '2', '8'), 
       (NULL, 'Memoria RAM HyperX FURY Black DDR4', 'Tipo de memoria interna: DDR4\r\nMemoria interna: 16 GB\r\nDiseño de memoria: 1 x 16 GB\r\nVelocidad de memoria del reloj: 2666 MHz\r\nLatencia CAS: 16\r\nFactor de Forma: 288-pin DIMM\r\n', '1339.00', '2', '8'), 
       (NULL, 'Memoria RAM XPG Hunter DDR4', 'Tipo de memoria interna: DDR4\r\nMemoria interna: 8 GB\r\nDiseño de memoria: 1 x 8 GB\r\nVelocidad de memoria del reloj: 2666 MHz\r\nLatencia CAS: 16\r\n', '639.00', '2', '8'),
       (NULL, 'Monitor Samsung S24F350FHL LED 24\"', 'Diagonal de la pantalla: 61 cm (24\")\r\nTipo HD: Full HD\r\nResolución: 1920 x 1080 Pixeles\r\nVelocidad de actualización: 60 Hz\r\nHDMI: 1x VGA: 1x\r\n\r\n', '2909.00', '3', '9'), 
       (NULL, 'Monitor Gamer ASUS VP228HE LED', 'Diagonal de la pantalla: 54,6 cm (21.5\")\r\nTipo HD: Full HD\r\nResolución: 1920 x 1080 Pixeles\r\nVelocidad de actualización: 75 Hz\r\nHDMI: 1x VGA: 1x\r\n\r\n', '2449.00', '3', '9'), 
       (NULL, 'Monitor Gamer Curvo Samsung LC27F390FHL ', 'Diagonal de la pantalla: 68,6 cm (27\")\r\nTipo HD: Full HD\r\nResolución: 1920 x 1080 Pixeles\r\nNvidia G-Sync: No, AMD FreeSync: Sí\r\nVelocidad de actualización: 60 Hz\r\nHDMI: 1x VGA: 1x\r\n\r\n', '4079.00', '3', '9'), 
       (NULL, 'Monitor Gamer Curvo XZEAL XZ4010', 'Diagonal de la pantalla: 68.6 cm (27\")\r\nTipo HD: Full HD\r\nResolución: 1920 x 1080 Pixeles\r\nNvidia G-Sync: Sí, AMD FreeSync: Sí\r\nVelocidad de actualización: 165 Hz\r\nDisplayPort: 1x\r\n\r\n', '5189.00', '3', '9'), 
       (NULL, 'Monitor Gamer Curvo Samsung LC32F391FWLXZX', 'Diagonal de la pantalla: 81,3 cm (32\")\r\nTipo HD: Full HD\r\nResolución: 1920 x 1080 Pixeles\r\nNvidia G-Sync: No, AMD FreeSync: No\r\nVelocidad de actualización: 60 Hz\r\nHDMI: 1x VGA: 0x DisplayPort: 1x DVI-I: 0x\r\n\r\n', '5479.00', '3', '9');
       
INSERT INTO `tipocotizacion` (`idTipoCotizacion`, `nombre`) VALUES (NULL, 'Compra'), (NULL, 'Venta');

INSERT INTO `cotizacion` (`id`, `total`, `fecha`, `idUsuario`, `idTipoCotizacion`) VALUES (NULL, '10000', '2021-01-01', '4', '1');

INSERT INTO `compcotizacion` (`idCotizacion`, `idComponente`) VALUES ('1', '2'), ('1', '10'), ('1', '12'), ('1', '30'), ('1', '21'), ('1', '16');