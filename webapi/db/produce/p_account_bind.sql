-- Script was generated by Devart dbForge Studio for MySQL, Version 5.0.50.0
-- Product home page: http://www.devart.com/dbforge/mysql/studio
-- Script date 2015/11/11 17:09:44
-- Server version: 5.5.36-log
-- Client version: 4.1

 

DELIMITER $$

CREATE DEFINER = 'root'@'%'
PROCEDURE p_account_bind(IN  vi_param VARCHAR(1024),
                         OUT vo_data  VARCHAR(1024),
                         OUT vo_res   INT
                         )
lab:
BEGIN
  DECLARE vi_type         TINYINT DEFAULT 0;
  DECLARE vi_openid       VARCHAR(32) DEFAULT '';
  DECLARE vi_userid       VARCHAR(32) DEFAULT '';
  DECLARE vi_access_token VARCHAR(32) DEFAULT NULL;
  DECLARE vi_nick         VARCHAR(64) DEFAULT NULL;
  DECLARE v_vstatus       TINYINT DEFAULT 0;
  DECLARE v_userid        INT DEFAULT 0;
  DECLARE v_count         TINYINT DEFAULT 0;
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SET vo_res = 9999;
  END;

  SET vi_type = getValue(vi_param, 'type'); #3:qq4wx5wb
  SET vi_openid = getValue(vi_param, 'openid');
  SET vi_userid = getValue(vi_param, 'userid');
  SET vi_access_token = getValue(vi_param, 'access_token');
  SET vi_nick = getValue(vi_param, 'nick');

  #getValue���صĿղ���NULL.����""
  IF (vi_userid = "" || vi_type = "" || vi_openid = "") THEN
    SET vo_res = 1007; #��������
    LEAVE lab;
  END IF;

  SELECT state
       , userid
  INTO
    v_vstatus, v_userid
  FROM
    qst_user_bind
  WHERE
    type = vi_type
    AND openid = vi_openid;

  IF (v_vstatus = 1) THEN
    SET vo_res = 1034;
    LEAVE lab;
  END IF;
  #SELECT v_userid     , vi_userid;
  IF (v_userid <> vi_userid) THEN
    INSERT INTO qst_user_bind (userid, openid, accesstoken, type, state, btime, nick) VALUES (vi_userid, vi_openid, vi_access_token, vi_type, 1, now(), vi_nick);
  ELSE
    UPDATE user_account_bind
    SET
      state = 1, btime = now()
    WHERE
      userid = vi_userid
      AND type = vi_type
      AND openid = vi_openid;
  END IF;

  SET vo_data = '';
  SET vo_res = 0;
END
$$

DELIMITER ;