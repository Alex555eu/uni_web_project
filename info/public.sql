/*
 Navicat Premium Data Transfer

 Source Server         : localhost_5433
 Source Server Type    : PostgreSQL
 Source Server Version : 160001 (160001)
 Source Host           : localhost:5433
 Source Catalog        : db
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 160001 (160001)
 File Encoding         : 65001

 Date: 02/02/2024 13:26:38
*/


-- ----------------------------
-- Sequence structure for cart_item_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."cart_item_id_seq";
CREATE SEQUENCE "public"."cart_item_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for order_details_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."order_details_id_seq";
CREATE SEQUENCE "public"."order_details_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for order_item_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."order_item_id_seq";
CREATE SEQUENCE "public"."order_item_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for product_category_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."product_category_id_seq";
CREATE SEQUENCE "public"."product_category_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for product_inventory_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."product_inventory_id_seq";
CREATE SEQUENCE "public"."product_inventory_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for product_inventory_id_seq1
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."product_inventory_id_seq1";
CREATE SEQUENCE "public"."product_inventory_id_seq1" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for store_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."store_id_seq";
CREATE SEQUENCE "public"."store_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Table structure for cart_item
-- ----------------------------
DROP TABLE IF EXISTS "public"."cart_item";
CREATE TABLE "public"."cart_item" (
  "id" int4 NOT NULL DEFAULT nextval('cart_item_id_seq'::regclass),
  "product_id" int4 NOT NULL,
  "quantity" int4 NOT NULL,
  "session_id" uuid NOT NULL
)
;

-- ----------------------------
-- Records of cart_item
-- ----------------------------

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS "public"."order_details";
CREATE TABLE "public"."order_details" (
  "id" int4 NOT NULL DEFAULT nextval('order_details_id_seq'::regclass),
  "total" numeric(10,2) NOT NULL,
  "user_id" uuid NOT NULL
)
;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO "public"."order_details" VALUES (20, 17.97, '4f8626f4-75bd-4606-90c8-123657aa31ff');
INSERT INTO "public"."order_details" VALUES (21, 5.99, '4f8626f4-75bd-4606-90c8-123657aa31ff');
INSERT INTO "public"."order_details" VALUES (22, 6.99, '4f8626f4-75bd-4606-90c8-123657aa31ff');
INSERT INTO "public"."order_details" VALUES (23, 69.90, '4f8626f4-75bd-4606-90c8-123657aa31ff');
INSERT INTO "public"."order_details" VALUES (24, 5.99, '4f8626f4-75bd-4606-90c8-123657aa31ff');
INSERT INTO "public"."order_details" VALUES (25, 5.99, 'da807565-23c2-434e-afea-7bbe4bccdd01');
INSERT INTO "public"."order_details" VALUES (26, 35.94, 'da807565-23c2-434e-afea-7bbe4bccdd01');

-- ----------------------------
-- Table structure for order_item
-- ----------------------------
DROP TABLE IF EXISTS "public"."order_item";
CREATE TABLE "public"."order_item" (
  "id" int4 NOT NULL DEFAULT nextval('order_item_id_seq'::regclass),
  "details_id" int4 NOT NULL,
  "product_id" int4 NOT NULL,
  "quantity" int4 NOT NULL
)
;

-- ----------------------------
-- Records of order_item
-- ----------------------------
INSERT INTO "public"."order_item" VALUES (15, 20, 2, 1);
INSERT INTO "public"."order_item" VALUES (16, 20, 5, 2);
INSERT INTO "public"."order_item" VALUES (17, 21, 7, 1);
INSERT INTO "public"."order_item" VALUES (18, 22, 16, 1);
INSERT INTO "public"."order_item" VALUES (19, 23, 16, 10);
INSERT INTO "public"."order_item" VALUES (20, 24, 5, 1);
INSERT INTO "public"."order_item" VALUES (21, 25, 15, 1);
INSERT INTO "public"."order_item" VALUES (22, 26, 5, 6);

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS "public"."product";
CREATE TABLE "public"."product" (
  "id" int4 NOT NULL DEFAULT nextval('product_inventory_id_seq'::regclass),
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "description" varchar(255) COLLATE "pg_catalog"."default",
  "inventory_id" int4 NOT NULL,
  "price" numeric(10,2) NOT NULL,
  "image" varchar(255) COLLATE "pg_catalog"."default" NOT NULL
)
;
COMMENT ON COLUMN "public"."product"."image" IS 'Path to image on server';

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO "public"."product" VALUES (9, 'life on mars', 'prod', 2, 5.99, 'public/images/product_images/Love_At_First_Bite.jpg');
INSERT INTO "public"."product" VALUES (2, 'doh nut', 'Dipped in pink glaze and topped with rainbow sprinkles!', 3, 5.99, 'public/images/product_images/D_Oh_Nut_1024x1024.jpg');
INSERT INTO "public"."product" VALUES (7, 'david hasselhoff', 'prod', 5, 5.99, 'public/images/product_images/David_Hasselhoff_1024x1024.jpg');
INSERT INTO "public"."product" VALUES (13, 'love at first bite', 'prod', 7, 5.99, 'public/images/product_images/Love_At_First_Bite.jpg');
INSERT INTO "public"."product" VALUES (8, 'ice bae', 'prod', 8, 5.99, 'public/images/product_images/Ice_Ice_Bae_Bae_1024x1024.jpg');
INSERT INTO "public"."product" VALUES (15, 'bruno mars', 'prod', 9, 5.99, 'public/images/product_images/Bruno_Mars.1_1024x1024.webp');
INSERT INTO "public"."product" VALUES (14, 'original', 'prod', 10, 5.99, 'public/images/product_images/OG_3744b222-303b-4c00-b485-385b00e2117c_1024x1024.jpg');
INSERT INTO "public"."product" VALUES (10, 'I make honey moves', 'prod', 11, 5.99, 'public/images/product_images/I_Make_Honey_Moves_8a8ab8e2-2225-47da-bf6b-012f45a1ffe2_1024x1024.jpg');
INSERT INTO "public"."product" VALUES (16, 'TEST', 'test', 12, 6.99, 'public/images/product_images/I_Make_Honey_Moves_8a8ab8e2-2225-47da-bf6b-012f45a1ffe2_1024x1024.jpg');
INSERT INTO "public"."product" VALUES (5, 'sia later', 'new description is added', 4, 5.99, 'public/images/product_images/Sia_Later_1024x1024.webp');

-- ----------------------------
-- Table structure for product_category
-- ----------------------------
DROP TABLE IF EXISTS "public"."product_category";
CREATE TABLE "public"."product_category" (
  "id" int4 NOT NULL DEFAULT nextval('product_category_id_seq'::regclass),
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "desc" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of product_category
-- ----------------------------
INSERT INTO "public"."product_category" VALUES (2, 'donuts', 'differnt types of donuts');
INSERT INTO "public"."product_category" VALUES (3, 'drinks', 'different types of drinks');

-- ----------------------------
-- Table structure for product_category_assignment
-- ----------------------------
DROP TABLE IF EXISTS "public"."product_category_assignment";
CREATE TABLE "public"."product_category_assignment" (
  "product_id" int4 NOT NULL,
  "product_category_id" int4 NOT NULL
)
;

-- ----------------------------
-- Records of product_category_assignment
-- ----------------------------
INSERT INTO "public"."product_category_assignment" VALUES (2, 2);
INSERT INTO "public"."product_category_assignment" VALUES (5, 2);
INSERT INTO "public"."product_category_assignment" VALUES (7, 2);
INSERT INTO "public"."product_category_assignment" VALUES (8, 2);
INSERT INTO "public"."product_category_assignment" VALUES (9, 2);
INSERT INTO "public"."product_category_assignment" VALUES (10, 2);
INSERT INTO "public"."product_category_assignment" VALUES (13, 2);
INSERT INTO "public"."product_category_assignment" VALUES (14, 2);
INSERT INTO "public"."product_category_assignment" VALUES (15, 2);
INSERT INTO "public"."product_category_assignment" VALUES (16, 2);

-- ----------------------------
-- Table structure for product_inventory
-- ----------------------------
DROP TABLE IF EXISTS "public"."product_inventory";
CREATE TABLE "public"."product_inventory" (
  "id" int4 NOT NULL DEFAULT nextval('product_inventory_id_seq1'::regclass),
  "quantity" numeric(10,2) NOT NULL,
  "store_id" int4 NOT NULL
)
;

-- ----------------------------
-- Records of product_inventory
-- ----------------------------
INSERT INTO "public"."product_inventory" VALUES (2, 10.00, 1);
INSERT INTO "public"."product_inventory" VALUES (8, 10.00, 1);
INSERT INTO "public"."product_inventory" VALUES (10, 10.00, 1);
INSERT INTO "public"."product_inventory" VALUES (11, 10.00, 1);
INSERT INTO "public"."product_inventory" VALUES (7, 9.00, 1);
INSERT INTO "public"."product_inventory" VALUES (3, 9.00, 1);
INSERT INTO "public"."product_inventory" VALUES (5, 9.00, 1);
INSERT INTO "public"."product_inventory" VALUES (12, 11.00, 2);
INSERT INTO "public"."product_inventory" VALUES (9, 9.00, 1);
INSERT INTO "public"."product_inventory" VALUES (4, 1.00, 1);

-- ----------------------------
-- Table structure for shopping_session
-- ----------------------------
DROP TABLE IF EXISTS "public"."shopping_session";
CREATE TABLE "public"."shopping_session" (
  "id" uuid NOT NULL DEFAULT uuid_generate_v4(),
  "user_id" uuid NOT NULL,
  "modified_at" timestamptz(6) NOT NULL
)
;

-- ----------------------------
-- Records of shopping_session
-- ----------------------------
INSERT INTO "public"."shopping_session" VALUES ('34f3b995-d98d-4e58-9044-afeb31ad34ff', '4f8626f4-75bd-4606-90c8-123657aa31ff', '2024-02-02 12:25:40.31122+00');

-- ----------------------------
-- Table structure for store
-- ----------------------------
DROP TABLE IF EXISTS "public"."store";
CREATE TABLE "public"."store" (
  "id" int4 NOT NULL DEFAULT nextval('store_id_seq'::regclass),
  "postal_code" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "city" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "address" varchar(255) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of store
-- ----------------------------
INSERT INTO "public"."store" VALUES (1, '32-300', 'Krakow', 'ul. Warszawska 24');
INSERT INTO "public"."store" VALUES (2, '32-301', 'Krakow', 'ul. Starowka 1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS "public"."user";
CREATE TABLE "public"."user" (
  "id" uuid NOT NULL DEFAULT uuid_generate_v4(),
  "password" text COLLATE "pg_catalog"."default" NOT NULL,
  "first_name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "last_name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "email_address" varchar(255) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO "public"."user" VALUES ('da807565-23c2-434e-afea-7bbe4bccdd01', '$2y$12$sB0IDLyAKhGBdYqoTmIkFeWbMQz..JQ0lbm2eRk5MKxIjF4wX2ai2', 'user', 'user', 'user@user.com');
INSERT INTO "public"."user" VALUES ('4f8626f4-75bd-4606-90c8-123657aa31ff', '$2y$12$0LSWQn5f4F.gjI/ZX9uFBOUCtTiSgEd6WcRQqs5D9.DkDg6oOW9V2', 'admin', 'admin', 'admin@admin.com');

-- ----------------------------
-- Table structure for worker
-- ----------------------------
DROP TABLE IF EXISTS "public"."worker";
CREATE TABLE "public"."worker" (
  "id" uuid NOT NULL DEFAULT uuid_generate_v4(),
  "store_id" int4 NOT NULL,
  "user_id" uuid NOT NULL,
  "authorization_level" int4 NOT NULL
)
;
COMMENT ON COLUMN "public"."worker"."authorization_level" IS '0 - worker ; 1 - owner';

-- ----------------------------
-- Records of worker
-- ----------------------------
INSERT INTO "public"."worker" VALUES ('340b162f-d1bc-4af3-8d41-7d554aa625df', 1, '4f8626f4-75bd-4606-90c8-123657aa31ff', 2);

-- ----------------------------
-- Function structure for _navicat_temp_stored_proc
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."_navicat_temp_stored_proc"("arg" uuid);
CREATE OR REPLACE FUNCTION "public"."_navicat_temp_stored_proc"("arg" uuid)
  RETURNS "pg_catalog"."uuid" AS $BODY$
	
	declare
		currt timestamptz;
		time_difference INT;
		res UUID;
	
	BEGIN
		select modified_at into currt from public.shopping_session where id = arg;
		
		if currt is null THEN
			RETURN NULL;
		end if;
	
	  time_difference := EXTRACT(EPOCH FROM now() - currt);

    IF time_difference > 60 THEN
        DELETE FROM public.shopping_session WHERE id = arg;
				RETURN NULL;
		ELSE 
				UPDATE public.shopping_session SET modified_at = now() WHERE id = arg;
				RETURN arg;
    END IF;

END$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Function structure for armor
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."armor"(bytea, _text, _text);
CREATE OR REPLACE FUNCTION "public"."armor"(bytea, _text, _text)
  RETURNS "pg_catalog"."text" AS '$libdir/pgcrypto', 'pg_armor'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for armor
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."armor"(bytea);
CREATE OR REPLACE FUNCTION "public"."armor"(bytea)
  RETURNS "pg_catalog"."text" AS '$libdir/pgcrypto', 'pg_armor'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for create_user_token
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."create_user_token"("arg" uuid);
CREATE OR REPLACE FUNCTION "public"."create_user_token"("arg" uuid)
  RETURNS "pg_catalog"."uuid" AS $BODY$
	
	DECLARE
		new_session UUID;
		tmp uuid;
	
	BEGIN
	
		DELETE FROM public.shopping_session WHERE user_id = arg;

		INSERT INTO public.shopping_session (user_id) VALUES (arg);
		
		SELECT into new_session id from public.shopping_session where user_id = arg;

		RETURN new_session;
	--RETURN;
END$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Function structure for crypt
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."crypt"(text, text);
CREATE OR REPLACE FUNCTION "public"."crypt"(text, text)
  RETURNS "pg_catalog"."text" AS '$libdir/pgcrypto', 'pg_crypt'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for dearmor
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."dearmor"(text);
CREATE OR REPLACE FUNCTION "public"."dearmor"(text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pg_dearmor'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for decrypt
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."decrypt"(bytea, bytea, text);
CREATE OR REPLACE FUNCTION "public"."decrypt"(bytea, bytea, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pg_decrypt'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for decrypt_iv
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."decrypt_iv"(bytea, bytea, bytea, text);
CREATE OR REPLACE FUNCTION "public"."decrypt_iv"(bytea, bytea, bytea, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pg_decrypt_iv'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for digest
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."digest"(text, text);
CREATE OR REPLACE FUNCTION "public"."digest"(text, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pg_digest'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for digest
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."digest"(bytea, text);
CREATE OR REPLACE FUNCTION "public"."digest"(bytea, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pg_digest'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for encrypt
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."encrypt"(bytea, bytea, text);
CREATE OR REPLACE FUNCTION "public"."encrypt"(bytea, bytea, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pg_encrypt'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for encrypt_iv
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."encrypt_iv"(bytea, bytea, bytea, text);
CREATE OR REPLACE FUNCTION "public"."encrypt_iv"(bytea, bytea, bytea, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pg_encrypt_iv'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for example_do_while
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."example_do_while"();
CREATE OR REPLACE FUNCTION "public"."example_do_while"()
  RETURNS "pg_catalog"."void" AS $BODY$
DECLARE
		arg1 INT;
		arg2 INT;
		arg3 INT;
		arg4 INT;
    --counter INT := 0;
BEGIN
INSERT INTO public.order_details (total, user_id) 
values(0,
	(	
		SELECT user_id
		FROM PUBLIC.shopping_session
		WHERE id = 'a955eab7-175d-4d48-999f-985701d2b6dc'
	)
)
RETURNING id INTO arg1;

  LOOP
		
  SELECT id into arg2 from public.cart_item where session_id = 'a955eab7-175d-4d48-999f-985701d2b6dc' LIMIT 1;    
	
	
	IF arg2 is null THEN
		EXIT;
	END IF;
	
	SELECT product_id, quantity into arg3, arg4 from public.cart_item where id = arg2;
	
	INSERT INTO public.order_item (details_id, product_id, quantity) VALUES (arg1, arg3, arg4);
	
	DELETE FROM public.cart_item where id = arg2;
	
  END LOOP;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Function structure for gen_random_bytes
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."gen_random_bytes"(int4);
CREATE OR REPLACE FUNCTION "public"."gen_random_bytes"(int4)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pg_random_bytes'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for gen_random_uuid
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."gen_random_uuid"();
CREATE OR REPLACE FUNCTION "public"."gen_random_uuid"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/pgcrypto', 'pg_random_uuid'
  LANGUAGE c VOLATILE
  COST 1;

-- ----------------------------
-- Function structure for gen_salt
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."gen_salt"(text);
CREATE OR REPLACE FUNCTION "public"."gen_salt"(text)
  RETURNS "pg_catalog"."text" AS '$libdir/pgcrypto', 'pg_gen_salt'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for gen_salt
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."gen_salt"(text, int4);
CREATE OR REPLACE FUNCTION "public"."gen_salt"(text, int4)
  RETURNS "pg_catalog"."text" AS '$libdir/pgcrypto', 'pg_gen_salt_rounds'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for hmac
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."hmac"(bytea, bytea, text);
CREATE OR REPLACE FUNCTION "public"."hmac"(bytea, bytea, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pg_hmac'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for hmac
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."hmac"(text, text, text);
CREATE OR REPLACE FUNCTION "public"."hmac"(text, text, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pg_hmac'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_armor_headers
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_armor_headers"(text, OUT "key" text, OUT "value" text);
CREATE OR REPLACE FUNCTION "public"."pgp_armor_headers"(IN text, OUT "key" text, OUT "value" text)
  RETURNS SETOF "pg_catalog"."record" AS '$libdir/pgcrypto', 'pgp_armor_headers'
  LANGUAGE c IMMUTABLE STRICT
  COST 1
  ROWS 1000;

-- ----------------------------
-- Function structure for pgp_key_id
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_key_id"(bytea);
CREATE OR REPLACE FUNCTION "public"."pgp_key_id"(bytea)
  RETURNS "pg_catalog"."text" AS '$libdir/pgcrypto', 'pgp_key_id_w'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_pub_decrypt
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_pub_decrypt"(bytea, bytea, text, text);
CREATE OR REPLACE FUNCTION "public"."pgp_pub_decrypt"(bytea, bytea, text, text)
  RETURNS "pg_catalog"."text" AS '$libdir/pgcrypto', 'pgp_pub_decrypt_text'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_pub_decrypt
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_pub_decrypt"(bytea, bytea);
CREATE OR REPLACE FUNCTION "public"."pgp_pub_decrypt"(bytea, bytea)
  RETURNS "pg_catalog"."text" AS '$libdir/pgcrypto', 'pgp_pub_decrypt_text'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_pub_decrypt
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_pub_decrypt"(bytea, bytea, text);
CREATE OR REPLACE FUNCTION "public"."pgp_pub_decrypt"(bytea, bytea, text)
  RETURNS "pg_catalog"."text" AS '$libdir/pgcrypto', 'pgp_pub_decrypt_text'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_pub_decrypt_bytea
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_pub_decrypt_bytea"(bytea, bytea);
CREATE OR REPLACE FUNCTION "public"."pgp_pub_decrypt_bytea"(bytea, bytea)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pgp_pub_decrypt_bytea'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_pub_decrypt_bytea
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_pub_decrypt_bytea"(bytea, bytea, text, text);
CREATE OR REPLACE FUNCTION "public"."pgp_pub_decrypt_bytea"(bytea, bytea, text, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pgp_pub_decrypt_bytea'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_pub_decrypt_bytea
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_pub_decrypt_bytea"(bytea, bytea, text);
CREATE OR REPLACE FUNCTION "public"."pgp_pub_decrypt_bytea"(bytea, bytea, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pgp_pub_decrypt_bytea'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_pub_encrypt
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_pub_encrypt"(text, bytea);
CREATE OR REPLACE FUNCTION "public"."pgp_pub_encrypt"(text, bytea)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pgp_pub_encrypt_text'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_pub_encrypt
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_pub_encrypt"(text, bytea, text);
CREATE OR REPLACE FUNCTION "public"."pgp_pub_encrypt"(text, bytea, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pgp_pub_encrypt_text'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_pub_encrypt_bytea
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_pub_encrypt_bytea"(bytea, bytea, text);
CREATE OR REPLACE FUNCTION "public"."pgp_pub_encrypt_bytea"(bytea, bytea, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pgp_pub_encrypt_bytea'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_pub_encrypt_bytea
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_pub_encrypt_bytea"(bytea, bytea);
CREATE OR REPLACE FUNCTION "public"."pgp_pub_encrypt_bytea"(bytea, bytea)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pgp_pub_encrypt_bytea'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_sym_decrypt
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_sym_decrypt"(bytea, text, text);
CREATE OR REPLACE FUNCTION "public"."pgp_sym_decrypt"(bytea, text, text)
  RETURNS "pg_catalog"."text" AS '$libdir/pgcrypto', 'pgp_sym_decrypt_text'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_sym_decrypt
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_sym_decrypt"(bytea, text);
CREATE OR REPLACE FUNCTION "public"."pgp_sym_decrypt"(bytea, text)
  RETURNS "pg_catalog"."text" AS '$libdir/pgcrypto', 'pgp_sym_decrypt_text'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_sym_decrypt_bytea
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_sym_decrypt_bytea"(bytea, text);
CREATE OR REPLACE FUNCTION "public"."pgp_sym_decrypt_bytea"(bytea, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pgp_sym_decrypt_bytea'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_sym_decrypt_bytea
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_sym_decrypt_bytea"(bytea, text, text);
CREATE OR REPLACE FUNCTION "public"."pgp_sym_decrypt_bytea"(bytea, text, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pgp_sym_decrypt_bytea'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_sym_encrypt
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_sym_encrypt"(text, text);
CREATE OR REPLACE FUNCTION "public"."pgp_sym_encrypt"(text, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pgp_sym_encrypt_text'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_sym_encrypt
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_sym_encrypt"(text, text, text);
CREATE OR REPLACE FUNCTION "public"."pgp_sym_encrypt"(text, text, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pgp_sym_encrypt_text'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_sym_encrypt_bytea
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_sym_encrypt_bytea"(bytea, text, text);
CREATE OR REPLACE FUNCTION "public"."pgp_sym_encrypt_bytea"(bytea, text, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pgp_sym_encrypt_bytea'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pgp_sym_encrypt_bytea
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pgp_sym_encrypt_bytea"(bytea, text);
CREATE OR REPLACE FUNCTION "public"."pgp_sym_encrypt_bytea"(bytea, text)
  RETURNS "pg_catalog"."bytea" AS '$libdir/pgcrypto', 'pgp_sym_encrypt_bytea'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for place_new_order
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."place_new_order"("arg_session_id" uuid);
CREATE OR REPLACE FUNCTION "public"."place_new_order"("arg_session_id" uuid)
  RETURNS "pg_catalog"."void" AS $BODY$
DECLARE
		new_order_details_id INT;
		cart_item_id INT;
		cart_item_product_id INT;
		cart_item_quantity INT;

BEGIN
INSERT INTO public.order_details (total, user_id) 
values(0,
	(	
		SELECT user_id
		FROM PUBLIC.shopping_session
		WHERE id = arg_session_id
	)
)
RETURNING id INTO new_order_details_id;

  LOOP
		
  SELECT id into cart_item_id from public.cart_item where session_id = arg_session_id LIMIT 1;    
	
	IF cart_item_id is null THEN
		EXIT;
	END IF;
	
	SELECT product_id, quantity into cart_item_product_id, cart_item_quantity from public.cart_item where id = cart_item_id;
	
	INSERT INTO public.order_item (details_id, product_id, quantity) VALUES (new_order_details_id, cart_item_product_id, cart_item_quantity);
	
	UPDATE public.product_inventory SET quantity = quantity - cart_item_quantity WHERE id = (SELECT inventory_id from public.product where id = cart_item_product_id);
	
	UPDATE public.order_details SET total = total + cart_item_quantity * (SELECT price from public.product where id = cart_item_product_id) WHERE id = new_order_details_id;
	
	DELETE FROM public.cart_item where id = cart_item_id;
	
  END LOOP;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Function structure for set_timestamp
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."set_timestamp"();
CREATE OR REPLACE FUNCTION "public"."set_timestamp"()
  RETURNS "pg_catalog"."trigger" AS $BODY$
BEGIN
  NEW.modified_at := now();
  RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Function structure for test_function
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."test_function"("arg" uuid);
CREATE OR REPLACE FUNCTION "public"."test_function"("arg" uuid)
  RETURNS "pg_catalog"."void" AS $BODY$
	
	declare
		currt timestamptz;
		time_difference INT;
	
	BEGIN
	-- Routine body goes here...

		select modified_at into currt from public.shopping_session where user_id = arg;
	
	  time_difference := EXTRACT(EPOCH FROM now() - currt);

    IF time_difference > 600 THEN
        DELETE FROM public.shopping_session WHERE user_id = arg;
		ELSE 
				UPDATE public.shopping_session SET modified_at = now() WHERE user_id = arg;
    END IF;

	RETURN;
END$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Function structure for test_function2
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."test_function2"("arg" uuid);
CREATE OR REPLACE FUNCTION "public"."test_function2"("arg" uuid)
  RETURNS "pg_catalog"."uuid" AS $BODY$
	
	declare
		currt timestamptz;
		time_difference INT;
		res UUID;
	
	BEGIN
		select modified_at into currt from public.shopping_session where id = arg;
		
		if currt is null THEN
			RETURN NULL;
		end if;
	
	  time_difference := EXTRACT(EPOCH FROM now() - currt);

    IF time_difference > 60 THEN
        DELETE FROM public.shopping_session WHERE id = arg;
				RETURN NULL;
		ELSE 
				UPDATE public.shopping_session SET modified_at = now() WHERE id = arg;
				RETURN arg;
    END IF;

END$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Function structure for update_trigger_function
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."update_trigger_function"();
CREATE OR REPLACE FUNCTION "public"."update_trigger_function"()
  RETURNS "pg_catalog"."trigger" AS $BODY$
DECLARE
    time_difference INT;
BEGIN
    -- Check the time difference in seconds
    time_difference := EXTRACT(EPOCH FROM NEW.modified_at - OLD.modified_at);
    -- Check the time difference
    IF time_difference > 0 THEN
        -- If the difference is greater than 1 minute, delete the record
        DELETE FROM public.shopping_session WHERE id = NEW.id; -- Replace with the actual table and primary key
    -- ELSE
        -- If the difference is 1 minute or less, update the timestamp to the current time
        -- UPDATE public.shopping_session SET modified_at = now() WHERE id = NEW.id; -- Replace with the actual table and columns
				-- NEW.modified_at = now();
    END IF;

    RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Function structure for uuid_generate_v1
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_generate_v1"();
CREATE OR REPLACE FUNCTION "public"."uuid_generate_v1"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_generate_v1'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_generate_v1mc
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_generate_v1mc"();
CREATE OR REPLACE FUNCTION "public"."uuid_generate_v1mc"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_generate_v1mc'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_generate_v3
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_generate_v3"("namespace" uuid, "name" text);
CREATE OR REPLACE FUNCTION "public"."uuid_generate_v3"("namespace" uuid, "name" text)
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_generate_v3'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_generate_v4
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_generate_v4"();
CREATE OR REPLACE FUNCTION "public"."uuid_generate_v4"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_generate_v4'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_generate_v5
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_generate_v5"("namespace" uuid, "name" text);
CREATE OR REPLACE FUNCTION "public"."uuid_generate_v5"("namespace" uuid, "name" text)
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_generate_v5'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_nil
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_nil"();
CREATE OR REPLACE FUNCTION "public"."uuid_nil"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_nil'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_ns_dns
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_ns_dns"();
CREATE OR REPLACE FUNCTION "public"."uuid_ns_dns"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_ns_dns'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_ns_oid
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_ns_oid"();
CREATE OR REPLACE FUNCTION "public"."uuid_ns_oid"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_ns_oid'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_ns_url
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_ns_url"();
CREATE OR REPLACE FUNCTION "public"."uuid_ns_url"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_ns_url'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_ns_x500
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_ns_x500"();
CREATE OR REPLACE FUNCTION "public"."uuid_ns_x500"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_ns_x500'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for validate_user_token
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."validate_user_token"("arg" uuid);
CREATE OR REPLACE FUNCTION "public"."validate_user_token"("arg" uuid)
  RETURNS "pg_catalog"."uuid" AS $BODY$
	
	declare
		currt timestamptz;
		time_difference INT;
		res UUID;
	
	BEGIN

		select modified_at into currt from public.shopping_session where id = arg;
		
		if currt is null THEN
			RETURN NULL;
		end if;
	
	  time_difference := EXTRACT(EPOCH FROM now() - currt);

    IF time_difference > 600 THEN
        DELETE FROM public.shopping_session WHERE id = arg;
				RETURN NULL;
		ELSE 
				UPDATE public.shopping_session SET modified_at = now() WHERE id = arg;
				RETURN arg;
    END IF;

END$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- View structure for orders_history
-- ----------------------------
DROP VIEW IF EXISTS "public"."orders_history";
CREATE VIEW "public"."orders_history" AS  SELECT od.id,
    od.total,
    array_agg(DISTINCT u.email_address) AS user_email,
    array_agg(ARRAY[p.id, oi.quantity]) AS product_quantity_pairs
   FROM order_details od
     JOIN order_item oi ON od.id = oi.details_id
     JOIN "user" u ON od.user_id = u.id
     JOIN product p ON p.id = oi.product_id
  GROUP BY od.id;

-- ----------------------------
-- View structure for product_details
-- ----------------------------
DROP VIEW IF EXISTS "public"."product_details";
CREATE VIEW "public"."product_details" AS  SELECT p.id,
    p.name,
    p.price,
    p.image,
    p.description,
    pc.name AS category,
    pi.quantity,
    pi.store_id
   FROM product p
     JOIN product_category_assignment pca ON p.id = pca.product_id
     JOIN product_category pc ON pca.product_category_id = pc.id
     JOIN product_inventory pi ON p.inventory_id = pi.id
     JOIN store s ON pi.store_id = s.id;

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."cart_item_id_seq"
OWNED BY "public"."cart_item"."id";
SELECT setval('"public"."cart_item_id_seq"', 58, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."order_details_id_seq"
OWNED BY "public"."order_details"."id";
SELECT setval('"public"."order_details_id_seq"', 26, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."order_item_id_seq"
OWNED BY "public"."order_item"."id";
SELECT setval('"public"."order_item_id_seq"', 22, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."product_category_id_seq"
OWNED BY "public"."product_category"."id";
SELECT setval('"public"."product_category_id_seq"', 3, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."product_inventory_id_seq"
OWNED BY "public"."product"."id";
SELECT setval('"public"."product_inventory_id_seq"', 63, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."product_inventory_id_seq1"
OWNED BY "public"."product_inventory"."id";
SELECT setval('"public"."product_inventory_id_seq1"', 72, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."store_id_seq"
OWNED BY "public"."store"."id";
SELECT setval('"public"."store_id_seq"', 2, true);

-- ----------------------------
-- Primary Key structure for table cart_item
-- ----------------------------
ALTER TABLE "public"."cart_item" ADD CONSTRAINT "cart_item_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table order_details
-- ----------------------------
ALTER TABLE "public"."order_details" ADD CONSTRAINT "order_details_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table order_item
-- ----------------------------
ALTER TABLE "public"."order_item" ADD CONSTRAINT "order_item_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table product
-- ----------------------------
ALTER TABLE "public"."product" ADD CONSTRAINT "prod_invent_uniq" UNIQUE ("inventory_id");
COMMENT ON CONSTRAINT "prod_invent_uniq" ON "public"."product" IS 'every product has its own inventory space';

-- ----------------------------
-- Primary Key structure for table product
-- ----------------------------
ALTER TABLE "public"."product" ADD CONSTRAINT "product_inventory_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table product_category
-- ----------------------------
ALTER TABLE "public"."product_category" ADD CONSTRAINT "product_category_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table product_category_assignment
-- ----------------------------
ALTER TABLE "public"."product_category_assignment" ADD CONSTRAINT "product_category_assignment_pkey" PRIMARY KEY ("product_id", "product_category_id");

-- ----------------------------
-- Primary Key structure for table product_inventory
-- ----------------------------
ALTER TABLE "public"."product_inventory" ADD CONSTRAINT "product_inventory_pkey1" PRIMARY KEY ("id");

-- ----------------------------
-- Triggers structure for table shopping_session
-- ----------------------------
CREATE TRIGGER "set_timestamp" BEFORE INSERT ON "public"."shopping_session"
FOR EACH ROW
EXECUTE PROCEDURE "public"."set_timestamp"();

-- ----------------------------
-- Uniques structure for table shopping_session
-- ----------------------------
ALTER TABLE "public"."shopping_session" ADD CONSTRAINT "uniq_user2" UNIQUE ("user_id");

-- ----------------------------
-- Primary Key structure for table shopping_session
-- ----------------------------
ALTER TABLE "public"."shopping_session" ADD CONSTRAINT "shopping_session2_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table store
-- ----------------------------
ALTER TABLE "public"."store" ADD CONSTRAINT "store_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table user
-- ----------------------------
ALTER TABLE "public"."user" ADD CONSTRAINT "email_uniq" UNIQUE ("email_address");

-- ----------------------------
-- Primary Key structure for table user
-- ----------------------------
ALTER TABLE "public"."user" ADD CONSTRAINT "user2_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table worker
-- ----------------------------
ALTER TABLE "public"."worker" ADD CONSTRAINT "user_uniq_1" UNIQUE ("user_id");

-- ----------------------------
-- Primary Key structure for table worker
-- ----------------------------
ALTER TABLE "public"."worker" ADD CONSTRAINT "worker2_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Foreign Keys structure for table cart_item
-- ----------------------------
ALTER TABLE "public"."cart_item" ADD CONSTRAINT "product" FOREIGN KEY ("product_id") REFERENCES "public"."product" ("id") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "public"."cart_item" ADD CONSTRAINT "session" FOREIGN KEY ("session_id") REFERENCES "public"."shopping_session" ("id") ON DELETE CASCADE ON UPDATE RESTRICT;

-- ----------------------------
-- Foreign Keys structure for table order_details
-- ----------------------------
ALTER TABLE "public"."order_details" ADD CONSTRAINT "user2" FOREIGN KEY ("user_id") REFERENCES "public"."user" ("id") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- ----------------------------
-- Foreign Keys structure for table order_item
-- ----------------------------
ALTER TABLE "public"."order_item" ADD CONSTRAINT "details" FOREIGN KEY ("details_id") REFERENCES "public"."order_details" ("id") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "public"."order_item" ADD CONSTRAINT "product" FOREIGN KEY ("product_id") REFERENCES "public"."product" ("id") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- ----------------------------
-- Foreign Keys structure for table product
-- ----------------------------
ALTER TABLE "public"."product" ADD CONSTRAINT "inventory" FOREIGN KEY ("inventory_id") REFERENCES "public"."product_inventory" ("id") ON DELETE CASCADE ON UPDATE RESTRICT;

-- ----------------------------
-- Foreign Keys structure for table product_category_assignment
-- ----------------------------
ALTER TABLE "public"."product_category_assignment" ADD CONSTRAINT "category" FOREIGN KEY ("product_category_id") REFERENCES "public"."product_category" ("id") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "public"."product_category_assignment" ADD CONSTRAINT "product" FOREIGN KEY ("product_id") REFERENCES "public"."product" ("id") ON DELETE CASCADE ON UPDATE RESTRICT;

-- ----------------------------
-- Foreign Keys structure for table product_inventory
-- ----------------------------
ALTER TABLE "public"."product_inventory" ADD CONSTRAINT "store" FOREIGN KEY ("store_id") REFERENCES "public"."store" ("id") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- ----------------------------
-- Foreign Keys structure for table shopping_session
-- ----------------------------
ALTER TABLE "public"."shopping_session" ADD CONSTRAINT "with_user" FOREIGN KEY ("user_id") REFERENCES "public"."user" ("id") ON DELETE RESTRICT ON UPDATE RESTRICT;

-- ----------------------------
-- Foreign Keys structure for table worker
-- ----------------------------
ALTER TABLE "public"."worker" ADD CONSTRAINT "store" FOREIGN KEY ("store_id") REFERENCES "public"."store" ("id") ON DELETE SET NULL ON UPDATE SET NULL;
ALTER TABLE "public"."worker" ADD CONSTRAINT "user" FOREIGN KEY ("user_id") REFERENCES "public"."user" ("id") ON DELETE CASCADE ON UPDATE CASCADE;
