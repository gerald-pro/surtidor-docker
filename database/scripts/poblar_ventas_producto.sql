DO $$
DECLARE c_nota int = 1;
c_detalle int = 1;
venta_id int;
nro_detalles int = 0;
producto_id int;
producto_precio decimal(8, 2);
producto_cantidad int;
monto_total decimal(8, 2) = 0;
fecha timestamp = '2022-01-01';
BEGIN while c_nota <= 2000 LOOP monto_total = 0;
c_detalle = 1;
nro_detalles = floor((random() * 3) + 1);
INSERT INTO nota_venta_producto (fecha, cliente_id, created_at)
VALUES (fecha, floor((random() * 19) + 1), NOW());
while c_detalle <= nro_detalles LOOP producto_cantidad = floor((random() * 2) + 1);
SELECT id,
    precio_venta
FROM producto into producto_id,
    producto_precio OFFSET floor((random() * 15) + 1)
LIMIT 1;
monto_total = (producto_cantidad * producto_precio) + monto_total;
INSERT INTO detalle_nota_venta_producto (
        cantidad,
        subtotal,
        nota_venta_producto_id,
        producto_id,
        created_at,
        updated_at
    )
VALUES (
        producto_cantidad,
        producto_cantidad * producto_precio,
        c_nota,
        producto_id,
        NOW(),
        NOW()
    );
c_detalle = c_detalle + 1;
END LOOP;
UPDATE nota_venta_producto
SET total = monto_total
WHERE nota_venta_producto.id = c_nota;
IF (round(random())::int)::boolean THEN fecha = fecha + INTERVAL '6 hour';
ELSE fecha = fecha + INTERVAL '156 minute';
END IF;
c_nota = c_nota + 1;
END LOOP;
END $$;