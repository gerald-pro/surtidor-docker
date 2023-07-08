CREATE or REPLACE FUNCTION listaAsistencia(id_turno int) 
RETURNS table(nombre varchar,fecha_entrada timestamp,fecha_salida timestamp) AS $$
declare 
	fila record;
	fila_asistencia record;
    registro_asistencia boolean = false;
BEGIN
	 drop table if exists asistencia_temporal;
	 create temporary table asistencia_temporal(nombre varchar,fecha_entrada timestamp,fecha_salida timestamp);
     for fila in select name, users_turnos.id 
				 from users
				 join users_turnos on users.id = users_turnos.user_id
				 where users_turnos.turno_id = id_turno
    loop 
		registro_asistencia = (select count(id) > 0 from asistencias where user_turno_id = fila.id);  
		if(registro_asistencia) then 
				select *  into fila_asistencia from asistencias where user_turno_id = fila.id limit 1;
		 		insert into  asistencia_temporal(nombre,fecha_entrada, fecha_salida) values(fila.name,fila_asistencia.fecha_entrada,fila_asistencia.fecha_salida);
		else
				insert into  asistencia_temporal(nombre,fecha_entrada, fecha_salida) values(fila.name,'1970-01-01 00:00:00','1970-01-01 00:00:00');
		end if;
    end loop;
RETURN query select * from asistencia_temporal;
END;
$$ LANGUAGE plpgsql;
