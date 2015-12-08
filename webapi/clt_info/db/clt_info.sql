-- Script was generated by Devart dbForge Studio for MySQL, Version 5.0.50.0
-- Product home page: http://www.devart.com/dbforge/mysql/studio
-- Script date 2015-4-28 19:04:25
-- Server version: 5.5.36-log
-- Client version: 4.1

USE qstdb;

CREATE TABLE qst_clt_info(
  id INT(11) NOT NULL AUTO_INCREMENT,
  appid VARCHAR(24) NOT NULL COMMENT 'Ӧ��id',
  token VARCHAR(32) NOT NULL COMMENT '�ͻ���Ψһid',
  mac VARCHAR(32) DEFAULT NULL COMMENT '��������mac��ַ,STR,����ȡ��������ȡ�����������ظ���',
  uuid VARCHAR(32) DEFAULT NULL COMMENT '�ͻ����û�ID[��ѡ]',
  os VARCHAR(16) NOT NULL COMMENT 'IOS,Android,winphone',
  osver VARCHAR(16) NOT NULL COMMENT 'ϵͳ�汾',
  model VARCHAR(16) DEFAULT NULL COMMENT '����',
  appver VARCHAR(16) DEFAULT NULL COMMENT 'Ӧ�ð汾',
  v_ip VARCHAR(16) DEFAULT NULL COMMENT 'IP��ַ',
  svr_ip VARCHAR(16) DEFAULT NULL COMMENT 'NodeServer IP��ַ',
  area VARCHAR(32) DEFAULT NULL COMMENT '����',
  network VARCHAR(8) DEFAULT NULL COMMENT '��������,STR,3g,2g,wifi',
  screen VARCHAR(32) DEFAULT NULL COMMENT '��Ļ�ߴ�STR(ʵ�ʳߴ�,��*��),�����retain��,Ҳ����������.��640*960,640*1136��',
  b_time DATETIME DEFAULT NULL COMMENT 'tokenд��ʱ��',
  installtime DATETIME DEFAULT NULL COMMENT '�汾��װʱ��STR,�п���ȡ���� YYYYMMDDHHMMSS',
  firstruntime DATETIME DEFAULT NULL COMMENT '�汾�״�����ʱ��STR, YYYYMMDDHHMMSS',
  PRIMARY KEY (id),
  UNIQUE INDEX UK_qst_clt_info2 (appid, token)
)
ENGINE = MYISAM
AUTO_INCREMENT = 20
AVG_ROW_LENGTH = 127
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = '�ͻ�����Ϣ';

CREATE TABLE qst_ver_plat(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ƽ̨ID',
  os VARCHAR(16) NOT NULL COMMENT 'ƽ̨:ios,android,winphone��linux��winows',
  osver VARCHAR(16) DEFAULT NULL COMMENT 'ϵͳ�汾',
  mode VARCHAR(16) DEFAULT NULL COMMENT '������Ϣ',
  dsp VARCHAR(64) NOT NULL COMMENT 'ƽ̨����',
  state INT(11) NOT NULL DEFAULT 0 COMMENT '0 ��Ч��1��Ч',
  PRIMARY KEY (id)
)
ENGINE = MYISAM
AUTO_INCREMENT = 3
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = '�û�����ϵͳƽ̨��Ϣ';

CREATE TABLE qst_ver_version(
  id INT(11) NOT NULL AUTO_INCREMENT,
  appid INT(11) NOT NULL COMMENT 'Ӧ��id',
  platid INT(11) NOT NULL COMMENT 'ƽ̨��ϢID:�� qst_plat ��id �ֶι���',
  state INT(11) NOT NULL DEFAULT 0 COMMENT '�汾״̬��0 ��ͨ���¡�1ǿ�Ƹ���',
  issue TINYINT(1) NOT NULL DEFAULT 0 COMMENT '�汾����״̬:0δ������1����',
  isHint TINYINT(1) NOT NULL DEFAULT 1 COMMENT '�汾�Ƿ���Ҫ��ʾ',
  ver VARCHAR(32) NOT NULL COMMENT '�汾��',
  hint VARCHAR(128) NOT NULL COMMENT '�汾��ʾ����',
  url VARCHAR(128) NOT NULL COMMENT '�汾����URL��ַ',
  btime DATE NOT NULL COMMENT '�汾��������',
  PRIMARY KEY (id)
)
ENGINE = MYISAM
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = '�û��汾����';

DELIMITER $$

CREATE DEFINER = 'livedb'@'%'
PROCEDURE p_clt_info_ext(IN  vi_param  VARCHAR(1024),
                         OUT vo_data   VARCHAR(1024),
                         OUT vo_result INT
                         )
PROC:
BEGIN
  DECLARE vi_token        VARCHAR(64) DEFAULT '';
  DECLARE vi_mac          VARCHAR(64) DEFAULT '';
  DECLARE vi_uuid         VARCHAR(64) DEFAULT '';
  DECLARE vi_os           VARCHAR(16) DEFAULT '';
  DECLARE vi_osver        VARCHAR(16) DEFAULT '';
  DECLARE vi_ver          VARCHAR(16) DEFAULT '';
  DECLARE vi_appver       VARCHAR(16) DEFAULT '';
  DECLARE vi_model        VARCHAR(16) DEFAULT '';
  DECLARE vi_ip           VARCHAR(16) DEFAULT '';
  DECLARE vi_svr_ip       VARCHAR(16) DEFAULT '';
  DECLARE vi_area         VARCHAR(32) DEFAULT '';
  DECLARE vi_network      VARCHAR(64) DEFAULT '';
  DECLARE vi_screen       VARCHAR(64) DEFAULT '';
  DECLARE vi_appid        VARCHAR(32) DEFAULT '';
  DECLARE vi_installtime  VARCHAR(32) DEFAULT '';
  DECLARE vi_firstruntime VARCHAR(32) DEFAULT '';
  DECLARE v_installtime   DATETIME;
  DECLARE v_firstruntime  DATETIME;
  DECLARE v_param         VARCHAR(1024) DEFAULT '';

  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SET vo_result = 9999;
  END;

  SET vi_appid = getValue(vi_param, 'appid');
  SET vi_token = getValue(vi_param, 'token');
  SET vi_mac = getValue(vi_param, 'mac');
  SET vi_uuid = getValue(vi_param, 'uuid');
  SET vi_os = getValue(vi_param, 'os');
  SET vi_osver = getValue(vi_param, 'osver');
  SET vi_model = getValue(vi_param, 'model');
  SET vi_ip = getValue(vi_param, 'ip');
  SET vi_svr_ip = getValue(vi_param, 'svr_ip');
  SET vi_area = getValue(vi_param, 'area');
  SET vi_screen = getValue(vi_param, 'screen');
  SET vi_network = getValue(vi_param, 'network');
  SET vi_appver = getValue(vi_param, 'ver');
  SET vi_installtime = getValue(vi_param, 'installtime');
  SET vi_firstruntime = getValue(vi_param, 'firstruntime');


  IF (vi_appid IS NULL OR vi_token IS NULL) THEN
    SET vo_result = 102029; #��������
    LEAVE PROC;
  END IF;

  IF (vi_installtime IS NOT NULL) THEN
    SET v_installtime = str_to_date(vi_installtime, '%Y%m%d%H%i%s');
  END IF;

  IF (vi_firstruntime IS NOT NULL) THEN
    SET v_firstruntime = str_to_date(vi_firstruntime, '%Y%m%d%H%i%s');
  END IF;


  INSERT INTO qst_clt_info (appid, token, mac, uuid, os, osver, appver, model, v_ip, svr_ip, area, b_time, network, screen, installtime, firstruntime) VALUES (vi_appid, vi_token, vi_mac, vi_uuid, vi_os, vi_osver, vi_appver, vi_model, vi_ip, vi_svr_ip, vi_area, now(), vi_network, vi_screen, v_installtime, v_firstruntime)
  ON DUPLICATE KEY UPDATE
    mac = vi_mac, uuid = vi_uuid, os = vi_os, osver = vi_osver, appver = vi_appver, model = vi_model, v_ip = vi_ip, svr_ip = vi_svr_ip, area = vi_area,
    network = vi_network, screen = vi_screen, installtime = v_installtime, firstruntime = v_firstruntime;

  SET vo_result = 0;

  SELECT a.ver
       , a.state
       , a.isHint
       , a.hint
       , a.url
  FROM
    qst_ver_version a
  LEFT JOIN qst_ver_plat b
  ON a.platid = b.id
  WHERE
    a.appid = vi_appid
    AND b.os = vi_os
    AND b.osver = vi_osver
    AND b.mode = vi_model;

END
$$

CREATE DEFINER = 'livedb'@'%'
FUNCTION addFmtString(f_string    VARCHAR(2048),
                      f_delimiter VARCHAR(2),
                      f_key       VARCHAR(16),
                      f_value     VARCHAR(128)
                      )
RETURNS VARCHAR(2048) CHARSET utf8
BEGIN
  IF (length(f_string) > 0) THEN
    SET f_string = concat(f_string, ",", f_key, f_delimiter, f_value);
  ELSE
    SET f_string = concat(f_string, f_key, f_delimiter, f_value);
  END IF;
  RETURN f_string;
END
$$

CREATE DEFINER = 'livedb'@'%'
FUNCTION func_split(f_string    VARCHAR(255),
                    f_delimiter CHAR(25),
                    f_order     INT
                    )
RETURNS VARCHAR(255) CHARSET utf8
BEGIN
  # ��ִ�����ַ��������ز�ֺ�����ַ��� 
  DECLARE result VARCHAR(255) DEFAULT '';

  SET result = reverse(substring_index(reverse(substring_index(f_string, f_delimiter, f_order)), f_delimiter, 1));
  RETURN result;
END
$$

CREATE DEFINER = 'livedb'@'%'
FUNCTION func_split_TotalLength(f_string    VARCHAR(255),
                                f_delimiter CHAR(25)
                                )
RETURNS INT(11)
BEGIN
  # ���㴫���ַ�������length 
  RETURN 1 + (length(f_string) - length(replace(f_string, f_delimiter, '')));
END
$$

CREATE DEFINER = 'livedb'@'%'
FUNCTION getValue(f_string VARCHAR(2048),
                  f_key    VARCHAR(16)
                  )
RETURNS VARCHAR(2048) CHARSET utf8
BEGIN
  DECLARE delim      VARCHAR(4) DEFAULT ',';
  DECLARE v_cnt      INT DEFAULT 0;
  DECLARE v_i        INT DEFAULT 0;
  DECLARE v_key      VARCHAR(16) DEFAULT '';
  DECLARE v_value    VARCHAR(128) DEFAULT '';
  DECLARE v_temp_str VARCHAR(128) DEFAULT '';

  #����

  SET v_cnt = func_split_TotalLength(f_string, delim);
  WHILE v_i < v_cnt
  DO
    SET v_i = v_i + 1;
    SET v_temp_str = func_split(f_string, delim, v_i);
    SELECT substring(v_temp_str, 1, locate(':', v_temp_str) - 1)
    INTO
      v_key;
    SELECT substring(v_temp_str, locate(':', v_temp_str) + 1)
    INTO
      v_value;
    IF (v_key = f_key) THEN
      RETURN v_value;
    END IF;
  END WHILE;

  RETURN '';
END
$$

DELIMITER ;