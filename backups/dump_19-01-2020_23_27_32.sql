--
-- PostgreSQL database cluster dump
--

SET default_transaction_read_only = off;

SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;

--
-- Drop databases (except postgres and template1)
--

DROP DATABASE openrpg;




--
-- Drop roles
--

DROP ROLE "openrpg-master";


--
-- Roles
--

CREATE ROLE "openrpg-master";
ALTER ROLE "openrpg-master" WITH SUPERUSER INHERIT CREATEROLE CREATEDB LOGIN REPLICATION BYPASSRLS PASSWORD 'md53aa99971aca7687ff8ea17e8d3ef8278';






--
-- PostgreSQL database dump
--

-- Dumped from database version 11.6 (Debian 11.6-1.pgdg90+1)
-- Dumped by pg_dump version 11.6 (Debian 11.6-1.pgdg90+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

UPDATE pg_catalog.pg_database SET datistemplate = false WHERE datname = 'template1';
DROP DATABASE template1;
--
-- Name: template1; Type: DATABASE; Schema: -; Owner: openrpg-master
--

CREATE DATABASE template1 WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.utf8' LC_CTYPE = 'en_US.utf8';


ALTER DATABASE template1 OWNER TO "openrpg-master";

\connect template1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: DATABASE template1; Type: COMMENT; Schema: -; Owner: openrpg-master
--

COMMENT ON DATABASE template1 IS 'default template for new databases';


--
-- Name: template1; Type: DATABASE PROPERTIES; Schema: -; Owner: openrpg-master
--

ALTER DATABASE template1 IS_TEMPLATE = true;


\connect template1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: DATABASE template1; Type: ACL; Schema: -; Owner: openrpg-master
--

REVOKE CONNECT,TEMPORARY ON DATABASE template1 FROM PUBLIC;
GRANT CONNECT ON DATABASE template1 TO PUBLIC;


--
-- PostgreSQL database dump complete
--

--
-- PostgreSQL database dump
--

-- Dumped from database version 11.6 (Debian 11.6-1.pgdg90+1)
-- Dumped by pg_dump version 11.6 (Debian 11.6-1.pgdg90+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: openrpg; Type: DATABASE; Schema: -; Owner: openrpg-master
--

CREATE DATABASE openrpg WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.utf8' LC_CTYPE = 'en_US.utf8';


ALTER DATABASE openrpg OWNER TO "openrpg-master";

\connect openrpg

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: adventures; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.adventures (
    id integer NOT NULL,
    campaign_id integer NOT NULL,
    title character varying(255) NOT NULL,
    description text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.adventures OWNER TO "openrpg-master";

--
-- Name: adventures_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.adventures_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adventures_id_seq OWNER TO "openrpg-master";

--
-- Name: adventures_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.adventures_id_seq OWNED BY public.adventures.id;


--
-- Name: auth_group; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.auth_group (
    id integer NOT NULL,
    name character varying(150) NOT NULL
);


ALTER TABLE public.auth_group OWNER TO "openrpg-master";

--
-- Name: auth_group_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.auth_group_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.auth_group_id_seq OWNER TO "openrpg-master";

--
-- Name: auth_group_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.auth_group_id_seq OWNED BY public.auth_group.id;


--
-- Name: auth_group_permissions; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.auth_group_permissions (
    id integer NOT NULL,
    group_id integer NOT NULL,
    permission_id integer NOT NULL
);


ALTER TABLE public.auth_group_permissions OWNER TO "openrpg-master";

--
-- Name: auth_group_permissions_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.auth_group_permissions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.auth_group_permissions_id_seq OWNER TO "openrpg-master";

--
-- Name: auth_group_permissions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.auth_group_permissions_id_seq OWNED BY public.auth_group_permissions.id;


--
-- Name: auth_permission; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.auth_permission (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    content_type_id integer NOT NULL,
    codename character varying(100) NOT NULL
);


ALTER TABLE public.auth_permission OWNER TO "openrpg-master";

--
-- Name: auth_permission_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.auth_permission_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.auth_permission_id_seq OWNER TO "openrpg-master";

--
-- Name: auth_permission_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.auth_permission_id_seq OWNED BY public.auth_permission.id;


--
-- Name: auth_user; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.auth_user (
    id integer NOT NULL,
    password character varying(128) NOT NULL,
    last_login timestamp with time zone,
    is_superuser boolean NOT NULL,
    username character varying(150) NOT NULL,
    first_name character varying(30) NOT NULL,
    last_name character varying(150) NOT NULL,
    email character varying(254) NOT NULL,
    is_staff boolean NOT NULL,
    is_active boolean NOT NULL,
    date_joined timestamp with time zone NOT NULL
);


ALTER TABLE public.auth_user OWNER TO "openrpg-master";

--
-- Name: auth_user_groups; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.auth_user_groups (
    id integer NOT NULL,
    user_id integer NOT NULL,
    group_id integer NOT NULL
);


ALTER TABLE public.auth_user_groups OWNER TO "openrpg-master";

--
-- Name: auth_user_groups_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.auth_user_groups_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.auth_user_groups_id_seq OWNER TO "openrpg-master";

--
-- Name: auth_user_groups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.auth_user_groups_id_seq OWNED BY public.auth_user_groups.id;


--
-- Name: auth_user_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.auth_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.auth_user_id_seq OWNER TO "openrpg-master";

--
-- Name: auth_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.auth_user_id_seq OWNED BY public.auth_user.id;


--
-- Name: auth_user_user_permissions; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.auth_user_user_permissions (
    id integer NOT NULL,
    user_id integer NOT NULL,
    permission_id integer NOT NULL
);


ALTER TABLE public.auth_user_user_permissions OWNER TO "openrpg-master";

--
-- Name: auth_user_user_permissions_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.auth_user_user_permissions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.auth_user_user_permissions_id_seq OWNER TO "openrpg-master";

--
-- Name: auth_user_user_permissions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.auth_user_user_permissions_id_seq OWNED BY public.auth_user_user_permissions.id;


--
-- Name: bonus_profession_skill_category; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.bonus_profession_skill_category (
    id integer NOT NULL,
    skill_category_id character varying(255) NOT NULL,
    profession_id character varying(255) NOT NULL,
    bonus integer DEFAULT 0 NOT NULL,
    dp character varying(255) NOT NULL
);


ALTER TABLE public.bonus_profession_skill_category OWNER TO "openrpg-master";

--
-- Name: bonus_profession_skill_category_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.bonus_profession_skill_category_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bonus_profession_skill_category_id_seq OWNER TO "openrpg-master";

--
-- Name: bonus_profession_skill_category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.bonus_profession_skill_category_id_seq OWNED BY public.bonus_profession_skill_category.id;


--
-- Name: campaigns; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.campaigns (
    id integer NOT NULL,
    gamemaster_id integer NOT NULL,
    title character varying(255) NOT NULL,
    description text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.campaigns OWNER TO "openrpg-master";

--
-- Name: campaigns_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.campaigns_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.campaigns_id_seq OWNER TO "openrpg-master";

--
-- Name: campaigns_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.campaigns_id_seq OWNED BY public.campaigns.id;


--
-- Name: characters; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.characters (
    id integer NOT NULL,
    user_id integer NOT NULL,
    name character varying(255) NOT NULL,
    experience integer NOT NULL,
    level integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.characters OWNER TO "openrpg-master";

--
-- Name: characters_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.characters_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.characters_id_seq OWNER TO "openrpg-master";

--
-- Name: characters_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.characters_id_seq OWNED BY public.characters.id;


--
-- Name: culture_skill_categories; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.culture_skill_categories (
    id integer NOT NULL,
    skill_category_id integer NOT NULL,
    culture_id integer NOT NULL,
    ranks character varying(255) NOT NULL
);


ALTER TABLE public.culture_skill_categories OWNER TO "openrpg-master";

--
-- Name: culture_skill_categories_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.culture_skill_categories_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.culture_skill_categories_id_seq OWNER TO "openrpg-master";

--
-- Name: culture_skill_categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.culture_skill_categories_id_seq OWNED BY public.culture_skill_categories.id;


--
-- Name: culture_skills; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.culture_skills (
    id integer NOT NULL,
    skill_id integer NOT NULL,
    culture_id integer NOT NULL,
    ranks character varying(255) NOT NULL
);


ALTER TABLE public.culture_skills OWNER TO "openrpg-master";

--
-- Name: culture_skills_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.culture_skills_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.culture_skills_id_seq OWNER TO "openrpg-master";

--
-- Name: culture_skills_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.culture_skills_id_seq OWNED BY public.culture_skills.id;


--
-- Name: cultures; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.cultures (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    hobbies_points integer NOT NULL
);


ALTER TABLE public.cultures OWNER TO "openrpg-master";

--
-- Name: cultures_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.cultures_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cultures_id_seq OWNER TO "openrpg-master";

--
-- Name: cultures_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.cultures_id_seq OWNED BY public.cultures.id;


--
-- Name: django_admin_log; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.django_admin_log (
    id integer NOT NULL,
    action_time timestamp with time zone NOT NULL,
    object_id text,
    object_repr character varying(200) NOT NULL,
    action_flag smallint NOT NULL,
    change_message text NOT NULL,
    content_type_id integer,
    user_id integer NOT NULL,
    CONSTRAINT django_admin_log_action_flag_check CHECK ((action_flag >= 0))
);


ALTER TABLE public.django_admin_log OWNER TO "openrpg-master";

--
-- Name: django_admin_log_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.django_admin_log_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.django_admin_log_id_seq OWNER TO "openrpg-master";

--
-- Name: django_admin_log_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.django_admin_log_id_seq OWNED BY public.django_admin_log.id;


--
-- Name: django_content_type; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.django_content_type (
    id integer NOT NULL,
    app_label character varying(100) NOT NULL,
    model character varying(100) NOT NULL
);


ALTER TABLE public.django_content_type OWNER TO "openrpg-master";

--
-- Name: django_content_type_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.django_content_type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.django_content_type_id_seq OWNER TO "openrpg-master";

--
-- Name: django_content_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.django_content_type_id_seq OWNED BY public.django_content_type.id;


--
-- Name: django_migrations; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.django_migrations (
    id integer NOT NULL,
    app character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    applied timestamp with time zone NOT NULL
);


ALTER TABLE public.django_migrations OWNER TO "openrpg-master";

--
-- Name: django_migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.django_migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.django_migrations_id_seq OWNER TO "openrpg-master";

--
-- Name: django_migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.django_migrations_id_seq OWNED BY public.django_migrations.id;


--
-- Name: django_session; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.django_session (
    session_key character varying(40) NOT NULL,
    session_data text NOT NULL,
    expire_date timestamp with time zone NOT NULL
);


ALTER TABLE public.django_session OWNER TO "openrpg-master";

--
-- Name: migrations; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO "openrpg-master";

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO "openrpg-master";

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO "openrpg-master";

--
-- Name: professions; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.professions (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    code character varying(255) NOT NULL,
    stat1 character varying(255) NOT NULL,
    stat2 character varying(255) NOT NULL,
    spell_realms json,
    spell_user_type character varying(255) NOT NULL,
    CONSTRAINT professions_spell_user_type_check CHECK (((spell_user_type)::text = ANY ((ARRAY['pure'::character varying, 'semi'::character varying, 'hybrid'::character varying, 'none'::character varying])::text[]))),
    CONSTRAINT professions_stat1_check CHECK (((stat1)::text = ANY ((ARRAY['Ag'::character varying, 'Co'::character varying, 'Me'::character varying, 'Ra'::character varying, 'Ad'::character varying, 'Em'::character varying, 'In'::character varying, 'Pr'::character varying, 'Fu'::character varying, 'Rp'::character varying])::text[]))),
    CONSTRAINT professions_stat2_check CHECK (((stat2)::text = ANY ((ARRAY['Ag'::character varying, 'Co'::character varying, 'Me'::character varying, 'Ra'::character varying, 'Ad'::character varying, 'Em'::character varying, 'In'::character varying, 'Pr'::character varying, 'Fu'::character varying, 'Rp'::character varying])::text[])))
);


ALTER TABLE public.professions OWNER TO "openrpg-master";

--
-- Name: professions_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.professions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.professions_id_seq OWNER TO "openrpg-master";

--
-- Name: professions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.professions_id_seq OWNED BY public.professions.id;


--
-- Name: professions_skills; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.professions_skills (
    id integer NOT NULL,
    profession_id character varying(255) NOT NULL,
    skill_id character varying(255) NOT NULL,
    type character varying(255) NOT NULL,
    CONSTRAINT professions_skills_type_check CHECK (((type)::text = ANY ((ARRAY['everyman'::character varying, 'occupational'::character varying, 'restricted'::character varying])::text[])))
);


ALTER TABLE public.professions_skills OWNER TO "openrpg-master";

--
-- Name: professions_skills_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.professions_skills_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.professions_skills_id_seq OWNER TO "openrpg-master";

--
-- Name: professions_skills_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.professions_skills_id_seq OWNED BY public.professions_skills.id;


--
-- Name: races; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.races (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    stats json NOT NULL,
    lifespan integer NOT NULL,
    background_points integer NOT NULL,
    resistance_rolls json NOT NULL,
    body_development character varying(255) NOT NULL,
    arcane_pp character varying(255) NOT NULL,
    essence_pp character varying(255) NOT NULL,
    channeling_pp character varying(255) NOT NULL,
    mentalism_pp character varying(255) NOT NULL,
    size character varying(255) NOT NULL,
    is_editable boolean NOT NULL,
    CONSTRAINT races_size_check CHECK (((size)::text = ANY ((ARRAY['very_small'::character varying, 'small'::character varying, 'medium'::character varying, 'big'::character varying, 'very_big'::character varying])::text[])))
);


ALTER TABLE public.races OWNER TO "openrpg-master";

--
-- Name: races_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.races_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.races_id_seq OWNER TO "openrpg-master";

--
-- Name: races_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.races_id_seq OWNED BY public.races.id;


--
-- Name: skill_categories; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.skill_categories (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    code character varying(255) NOT NULL,
    stats character varying(255) NOT NULL,
    progression character varying(255) NOT NULL,
    is_sortable boolean NOT NULL,
    is_editable boolean NOT NULL,
    CONSTRAINT skill_categories_progression_check CHECK (((progression)::text = ANY ((ARRAY['standard'::character varying, 'limited'::character varying, 'combined'::character varying, 'special'::character varying])::text[])))
);


ALTER TABLE public.skill_categories OWNER TO "openrpg-master";

--
-- Name: skill_categories_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.skill_categories_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.skill_categories_id_seq OWNER TO "openrpg-master";

--
-- Name: skill_categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.skill_categories_id_seq OWNED BY public.skill_categories.id;


--
-- Name: skills; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.skills (
    id integer NOT NULL,
    skill_category_id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    code character varying(255) NOT NULL,
    description text NOT NULL
);


ALTER TABLE public.skills OWNER TO "openrpg-master";

--
-- Name: skills_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.skills_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.skills_id_seq OWNER TO "openrpg-master";

--
-- Name: skills_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.skills_id_seq OWNED BY public.skills.id;


--
-- Name: spell_list_dps; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.spell_list_dps (
    id integer NOT NULL,
    spell_user_type character varying(255) NOT NULL,
    own_realm json NOT NULL,
    other_realm json NOT NULL,
    is_editable boolean NOT NULL
);


ALTER TABLE public.spell_list_dps OWNER TO "openrpg-master";

--
-- Name: spell_list_dps_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.spell_list_dps_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.spell_list_dps_id_seq OWNER TO "openrpg-master";

--
-- Name: spell_list_dps_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.spell_list_dps_id_seq OWNED BY public.spell_list_dps.id;


--
-- Name: spell_lists; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.spell_lists (
    id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    name text NOT NULL,
    list_type text NOT NULL,
    description text NOT NULL,
    notes text NOT NULL
);


ALTER TABLE public.spell_lists OWNER TO "openrpg-master";

--
-- Name: spell_lists_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.spell_lists_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.spell_lists_id_seq OWNER TO "openrpg-master";

--
-- Name: spell_lists_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.spell_lists_id_seq OWNED BY public.spell_lists.id;


--
-- Name: spells; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.spells (
    id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    level integer NOT NULL,
    name text NOT NULL,
    description text NOT NULL,
    list_name text NOT NULL,
    code character varying(5) NOT NULL,
    class character varying(5) NOT NULL,
    subclass character varying(5) NOT NULL,
    effect_area json NOT NULL,
    duration json NOT NULL,
    range json NOT NULL,
    notes text,
    list_id integer,
    searchtext tsvector
);


ALTER TABLE public.spells OWNER TO "openrpg-master";

--
-- Name: spells_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.spells_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.spells_id_seq OWNER TO "openrpg-master";

--
-- Name: spells_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.spells_id_seq OWNED BY public.spells.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: openrpg-master
--

CREATE TABLE public.users (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    api_token character varying(80),
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO "openrpg-master";

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: openrpg-master
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO "openrpg-master";

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: openrpg-master
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: adventures id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.adventures ALTER COLUMN id SET DEFAULT nextval('public.adventures_id_seq'::regclass);


--
-- Name: auth_group id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_group ALTER COLUMN id SET DEFAULT nextval('public.auth_group_id_seq'::regclass);


--
-- Name: auth_group_permissions id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_group_permissions ALTER COLUMN id SET DEFAULT nextval('public.auth_group_permissions_id_seq'::regclass);


--
-- Name: auth_permission id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_permission ALTER COLUMN id SET DEFAULT nextval('public.auth_permission_id_seq'::regclass);


--
-- Name: auth_user id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_user ALTER COLUMN id SET DEFAULT nextval('public.auth_user_id_seq'::regclass);


--
-- Name: auth_user_groups id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_user_groups ALTER COLUMN id SET DEFAULT nextval('public.auth_user_groups_id_seq'::regclass);


--
-- Name: auth_user_user_permissions id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_user_user_permissions ALTER COLUMN id SET DEFAULT nextval('public.auth_user_user_permissions_id_seq'::regclass);


--
-- Name: bonus_profession_skill_category id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.bonus_profession_skill_category ALTER COLUMN id SET DEFAULT nextval('public.bonus_profession_skill_category_id_seq'::regclass);


--
-- Name: campaigns id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.campaigns ALTER COLUMN id SET DEFAULT nextval('public.campaigns_id_seq'::regclass);


--
-- Name: characters id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.characters ALTER COLUMN id SET DEFAULT nextval('public.characters_id_seq'::regclass);


--
-- Name: culture_skill_categories id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.culture_skill_categories ALTER COLUMN id SET DEFAULT nextval('public.culture_skill_categories_id_seq'::regclass);


--
-- Name: culture_skills id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.culture_skills ALTER COLUMN id SET DEFAULT nextval('public.culture_skills_id_seq'::regclass);


--
-- Name: cultures id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.cultures ALTER COLUMN id SET DEFAULT nextval('public.cultures_id_seq'::regclass);


--
-- Name: django_admin_log id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.django_admin_log ALTER COLUMN id SET DEFAULT nextval('public.django_admin_log_id_seq'::regclass);


--
-- Name: django_content_type id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.django_content_type ALTER COLUMN id SET DEFAULT nextval('public.django_content_type_id_seq'::regclass);


--
-- Name: django_migrations id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.django_migrations ALTER COLUMN id SET DEFAULT nextval('public.django_migrations_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: professions id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.professions ALTER COLUMN id SET DEFAULT nextval('public.professions_id_seq'::regclass);


--
-- Name: professions_skills id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.professions_skills ALTER COLUMN id SET DEFAULT nextval('public.professions_skills_id_seq'::regclass);


--
-- Name: races id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.races ALTER COLUMN id SET DEFAULT nextval('public.races_id_seq'::regclass);


--
-- Name: skill_categories id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.skill_categories ALTER COLUMN id SET DEFAULT nextval('public.skill_categories_id_seq'::regclass);


--
-- Name: skills id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.skills ALTER COLUMN id SET DEFAULT nextval('public.skills_id_seq'::regclass);


--
-- Name: spell_list_dps id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.spell_list_dps ALTER COLUMN id SET DEFAULT nextval('public.spell_list_dps_id_seq'::regclass);


--
-- Name: spell_lists id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.spell_lists ALTER COLUMN id SET DEFAULT nextval('public.spell_lists_id_seq'::regclass);


--
-- Name: spells id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.spells ALTER COLUMN id SET DEFAULT nextval('public.spells_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: adventures; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.adventures (id, campaign_id, title, description, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: auth_group; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.auth_group (id, name) FROM stdin;
\.


--
-- Data for Name: auth_group_permissions; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.auth_group_permissions (id, group_id, permission_id) FROM stdin;
\.


--
-- Data for Name: auth_permission; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.auth_permission (id, name, content_type_id, codename) FROM stdin;
1	Can add log entry	1	add_logentry
2	Can change log entry	1	change_logentry
3	Can delete log entry	1	delete_logentry
4	Can view log entry	1	view_logentry
5	Can add permission	2	add_permission
6	Can change permission	2	change_permission
7	Can delete permission	2	delete_permission
8	Can view permission	2	view_permission
9	Can add group	3	add_group
10	Can change group	3	change_group
11	Can delete group	3	delete_group
12	Can view group	3	view_group
13	Can add user	4	add_user
14	Can change user	4	change_user
15	Can delete user	4	delete_user
16	Can view user	4	view_user
17	Can add content type	5	add_contenttype
18	Can change content type	5	change_contenttype
19	Can delete content type	5	delete_contenttype
20	Can view content type	5	view_contenttype
21	Can add session	6	add_session
22	Can change session	6	change_session
23	Can delete session	6	delete_session
24	Can view session	6	view_session
25	Can add spell	7	add_spell
26	Can change spell	7	change_spell
27	Can delete spell	7	delete_spell
28	Can view spell	7	view_spell
29	Can add spell list	8	add_spelllist
30	Can change spell list	8	change_spelllist
31	Can delete spell list	8	delete_spelllist
32	Can view spell list	8	view_spelllist
\.


--
-- Data for Name: auth_user; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.auth_user (id, password, last_login, is_superuser, username, first_name, last_name, email, is_staff, is_active, date_joined) FROM stdin;
1	pbkdf2_sha256$180000$k9PteXxZqZUV$+6MJV2kSpF46ZvJwJTuq3yR982Tp+XmUZ7Fe5KlKrjU=	2020-01-18 10:26:14.133476+00	t	admin				t	t	2020-01-15 22:17:38.164528+00
\.


--
-- Data for Name: auth_user_groups; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.auth_user_groups (id, user_id, group_id) FROM stdin;
\.


--
-- Data for Name: auth_user_user_permissions; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.auth_user_user_permissions (id, user_id, permission_id) FROM stdin;
\.


--
-- Data for Name: bonus_profession_skill_category; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.bonus_profession_skill_category (id, skill_category_id, profession_id, bonus, dp) FROM stdin;
1	Autoc	bardo	5	2/7
2	Comun	bardo	5	1/1/1
3	DesFis	bardo	5	6/14
4	Infl	bardo	5	1/4
5	PerPod	bardo	5	3/6
\.


--
-- Data for Name: campaigns; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.campaigns (id, gamemaster_id, title, description, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: characters; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.characters (id, user_id, name, experience, level, created_at, updated_at) FROM stdin;
5	1	Rygar	51887	5	2020-01-18 11:07:26	2020-01-18 11:07:26
1	1	Thranduil	60181	5	2020-01-18 11:05:41	2020-01-18 19:52:10
2	1	Valfur	58592	5	2020-01-18 11:06:03	2020-01-18 19:53:52
3	1	Maynard	62246	5	2020-01-18 11:06:34	2020-01-18 19:55:27
4	1	Ixastophanis	61188	5	2020-01-18 11:07:04	2020-01-18 19:57:20
\.


--
-- Data for Name: culture_skill_categories; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.culture_skill_categories (id, skill_category_id, culture_id, ranks) FROM stdin;
\.


--
-- Data for Name: culture_skills; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.culture_skills (id, skill_id, culture_id, ranks) FROM stdin;
\.


--
-- Data for Name: cultures; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.cultures (id, name, hobbies_points) FROM stdin;
\.


--
-- Data for Name: django_admin_log; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.django_admin_log (id, action_time, object_id, object_repr, action_flag, change_message, content_type_id, user_id) FROM stdin;
1	2020-01-15 22:30:42.330413+00	1	SpellList object (1)	2	[{"changed": {"fields": ["Name"]}}]	8	1
2	2020-01-15 23:23:21.270659+00	4	5 - Mas rapido I - Amplificaciones - El objetivo puede actuar al do...	2	[{"changed": {"fields": ["Effect area", "Duration", "Range"]}}]	7	1
3	2020-01-15 23:27:53.264921+00	4	5 - Mas rapido I - Amplificaciones - El objetivo puede actuar al do...	2	[{"changed": {"fields": ["Effect area", "Duration", "Range"]}}]	7	1
4	2020-01-15 23:29:43.695105+00	4	5 - Mas rapido I - Amplificaciones - El objetivo puede actuar al do...	2	[{"changed": {"fields": ["Effect area", "Duration", "Range"]}}]	7	1
5	2020-01-15 23:31:29.385257+00	4	5 - Mas rapido I - Amplificaciones - El objetivo puede actuar al do...	2	[{"changed": {"fields": ["Effect area", "Duration", "Range"]}}]	7	1
6	2020-01-15 23:34:10.058521+00	4	5 - Mas rapido I - Amplificaciones - El objetivo puede actuar al do...	2	[{"changed": {"fields": ["Effect area", "Duration", "Range"]}}]	7	1
7	2020-01-15 23:34:34.640067+00	4	5 - Mas rapido I - Amplificaciones - El objetivo puede actuar al do...	2	[{"changed": {"fields": ["Effect area", "Duration", "Range"]}}]	7	1
8	2020-01-15 23:34:44.861538+00	4	5 - Mas rapido I - Amplificaciones - El objetivo puede actuar al do...	2	[{"changed": {"fields": ["Effect area", "Duration", "Range"]}}]	7	1
\.


--
-- Data for Name: django_content_type; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.django_content_type (id, app_label, model) FROM stdin;
1	admin	logentry
2	auth	permission
3	auth	group
4	auth	user
5	contenttypes	contenttype
6	sessions	session
7	spells	spell
8	spells	spelllist
\.


--
-- Data for Name: django_migrations; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.django_migrations (id, app, name, applied) FROM stdin;
1	contenttypes	0001_initial	2020-01-14 23:43:26.849522+00
2	auth	0001_initial	2020-01-14 23:43:26.887723+00
3	admin	0001_initial	2020-01-14 23:43:26.9485+00
4	admin	0002_logentry_remove_auto_add	2020-01-14 23:43:26.972922+00
5	admin	0003_logentry_add_action_flag_choices	2020-01-14 23:43:27.000618+00
6	contenttypes	0002_remove_content_type_name	2020-01-14 23:43:27.017081+00
7	auth	0002_alter_permission_name_max_length	2020-01-14 23:43:27.023521+00
8	auth	0003_alter_user_email_max_length	2020-01-14 23:43:27.031229+00
9	auth	0004_alter_user_username_opts	2020-01-14 23:43:27.038441+00
10	auth	0005_alter_user_last_login_null	2020-01-14 23:43:27.045861+00
11	auth	0006_require_contenttypes_0002	2020-01-14 23:43:27.047988+00
12	auth	0007_alter_validators_add_error_messages	2020-01-14 23:43:27.055173+00
13	auth	0008_alter_user_username_max_length	2020-01-14 23:43:27.066841+00
14	auth	0009_alter_user_last_name_max_length	2020-01-14 23:43:27.074261+00
15	auth	0010_alter_group_name_max_length	2020-01-14 23:43:27.081901+00
16	auth	0011_update_proxy_permissions	2020-01-14 23:43:27.089085+00
17	sessions	0001_initial	2020-01-14 23:43:27.098413+00
18	spells	0001_initial	2020-01-14 23:43:27.112786+00
\.


--
-- Data for Name: django_session; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.django_session (session_key, session_data, expire_date) FROM stdin;
oatffjlxffny177k1rz79vd9ihd8gn1g	ZDkyOGE0N2Y0YTNmMTkyMDIyMjlmZjZjMGFmNjVhMzZhYThjZmFlZTp7Il9hdXRoX3VzZXJfaWQiOiIxIiwiX2F1dGhfdXNlcl9iYWNrZW5kIjoiZGphbmdvLmNvbnRyaWIuYXV0aC5iYWNrZW5kcy5Nb2RlbEJhY2tlbmQiLCJfYXV0aF91c2VyX2hhc2giOiI4NDkzYTI4MGViMjc3YzBmMDZkYzMzZTdlODIwNGI2NmEzZTliNTJlIn0=	2020-01-29 22:17:47.58707+00
wmxgulwhuskzc37o37jkvnycyjhip9u4	ZDkyOGE0N2Y0YTNmMTkyMDIyMjlmZjZjMGFmNjVhMzZhYThjZmFlZTp7Il9hdXRoX3VzZXJfaWQiOiIxIiwiX2F1dGhfdXNlcl9iYWNrZW5kIjoiZGphbmdvLmNvbnRyaWIuYXV0aC5iYWNrZW5kcy5Nb2RlbEJhY2tlbmQiLCJfYXV0aF91c2VyX2hhc2giOiI4NDkzYTI4MGViMjc3YzBmMDZkYzMzZTdlODIwNGI2NmEzZTliNTJlIn0=	2020-02-01 09:57:34.447469+00
9r3z3hc9krak2ufgl82h61szg1t86ren	ZDkyOGE0N2Y0YTNmMTkyMDIyMjlmZjZjMGFmNjVhMzZhYThjZmFlZTp7Il9hdXRoX3VzZXJfaWQiOiIxIiwiX2F1dGhfdXNlcl9iYWNrZW5kIjoiZGphbmdvLmNvbnRyaWIuYXV0aC5iYWNrZW5kcy5Nb2RlbEJhY2tlbmQiLCJfYXV0aF91c2VyX2hhc2giOiI4NDkzYTI4MGViMjc3YzBmMDZkYzMzZTdlODIwNGI2NmEzZTliNTJlIn0=	2020-02-01 10:26:14.135341+00
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.migrations (id, migration, batch) FROM stdin;
169	2014_10_12_100000_create_password_resets_table	1
170	2019_07_28_181541_create_users_table	1
171	2019_08_31_200038_create_skill_category_table	1
172	2019_09_03_193930_spell_list_costs	1
173	2019_09_07_221644_races	1
174	2019_09_08_110739_cultures	1
175	2019_09_08_114630_cultures_skills	1
176	2019_09_14_200743_professions	1
177	2019_09_14_214505_create_bonus_profession_skill_category	1
178	2019_09_15_181943_create_professions_skills	1
179	2019_09_22_102100_create_characters	1
180	2019_11_10_114924_create_campaigns_table	1
181	2019_11_10_184658_create_adventures_table	1
182	2020_01_05_124105_create_spells_table	1
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: professions; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.professions (id, name, code, stat1, stat2, spell_realms, spell_user_type) FROM stdin;
1	Bardo	bardo	Me	Pr	["Men"]	semi
\.


--
-- Data for Name: professions_skills; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.professions_skills (id, profession_id, skill_id, type) FROM stdin;
1	bardo	sentido_del_tiempo	everyman
\.


--
-- Data for Name: races; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.races (id, name, stats, lifespan, background_points, resistance_rolls, body_development, arcane_pp, essence_pp, channeling_pp, mentalism_pp, size, is_editable) FROM stdin;
\.


--
-- Data for Name: skill_categories; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.skill_categories (id, name, code, stats, progression, is_sortable, is_editable) FROM stdin;
1	Armadura·Ligera	ArdL	Ag/Fu/Ag	standard	f	f
2	Armadura·Media	ArdM	Fu/Ag/Fu	standard	f	f
3	Armadura·Pesada	ArdP	Fu/Ag/Fu	standard	f	f
4	Armas·2manos	Arm2M	Fu/Ag/Fu	standard	t	f
5	Armas·Arrojadizas	ArmAj	Ag/Fu/Ag	standard	t	f
6	Armas·Artillería	ArmAt	In/Ag/Ra	standard	t	f
7	Armas·Contundentes	ArmC	Fu/Ag/Fu	standard	t	f
8	Armas·Asta	ArmAs	Fu/Ag/Fu	standard	t	f
9	Armas·Filo	ArmF	Fu/Ag/Fu	standard	t	f
10	Armas·Proyectiles	ArmPr	Ag/Fu/Ag	standard	t	f
11	Arte·Activo	ArtA	Pr/Em/Ag	standard	f	f
12	Arte·Pasivo	ArtP	Em/In/Pr	standard	f	f
13	Artes Marciales·Barridos	AmB	Ag/Fu/Fu	standard	f	f
14	Artes Marciales·Golpes	AmG	Fu/Ag/Fu	standard	f	f
15	Artes Marciales·Maniobras de Combate	AmMC	Ag/Rp/Ag	combined	f	f
16	Ataques Especiales	AtaEsp	Fu/Ag/Ad	combined	f	f
17	Atletismo·Gimnasia	AtlG	Ag/Rp/Ag	standard	f	f
18	Atletismo·Potencia	AtlP	Fu/Co/Ag	standard	f	f
19	Atletismo·Resistencia	AtlR	Co/Ag/Fu	standard	f	f
20	Autocontrol	Autoc	Ad/Pr/Ad	standard	f	f
21	Ciencia/Analítica·Básica	CienB	Ra/Me/Ra	standard	f	f
22	Ciencia/Analítica·Especializada	CienE	Ra/Me/Ra	combined	f	f
23	Comunicación	Comun	Ra/Me/Em	standard	f	f
24	Conocimiento·General	ConGen	Me/Ra/Me	standard	f	f
25	Conocimiento·Mágico	ConMag	Me/Ra/Me	standard	f	f
26	Conocimiento·Oscuro	ConOsc	Me/Ra/Me	standard	f	f
27	Conocimiento·Técnico	ConTec	Me/Ra/Me	standard	f	f
28	Defensas Especiales	DefEsp	Ninguna	combined	f	f
29	Desarrollo de Puntos de Poder	DesPP	*	special	f	f
30	Desarrollo Físico	DesFis	Co/Ad/Co	special	f	f
31	Exteriores·Animales	ExtAni	Em/Ag/Em	standard	f	f
32	Exteriores·Entorno	ExtEnt	Ad/In/Me	standard	f	f
33	Hechizos Dirigidos	HecDir	Ag/Ad/Ag	standard	f	f
34	Listas Básicas de Hechizos	ListBas	*	limited	f	f
35	Listas Abiertas de Hechizos	ListAb	*	limited	f	f
36	Listas Cerradas de Hechizos	ListCerr	*	limited	f	f
37	Listas Básicas de Otras Profesiones	ListBasOt	*	limited	f	f
38	Listas Abiertas de Otros Reinos	ListAbOt	*	limited	f	f
39	Listas Cerradas de Otros Reinos	ListCerrOt	*	limited	f	f
40	Listas Básicas de Otros Reinos	ListBasOtR	*	limited	f	f
41	Listas Abiertas Arcanas	ListAbArc	*	limited	f	f
42	Listas Hechizos de Adiestramiento	ListAd	*	limited	f	f
43	Listas Hechizos de Adiestramientos de Otros Reinos	ListAdOtR	*	limited	f	f
44	Listas Básicas de la Tríada	ListTri	*	limited	f	f
45	Listas Básicas Elementales Complementarias	ListElCom	*	limited	f	f
46	Influencia	Infl	Pr/Em/In	standard	f	f
47	Maniobras de Combate	ManCom	Ag/Rp/Ad	combined	f	f
48	Manipulación del Poder	ManPod	Em/In/Ad	combined	f	f
49	Oficios	Ofi	Ag/Me/Ad	combined	f	f
50	Percepción·Búsqueda	PerBus	In/Ra/Ad	standard	f	f
51	Percepción·Perspicacia	PerPers	In/Ad/In	limited	f	f
52	Percepción·Sentidos	PerSen	In/Ad/In	standard	f	f
53	Percepción de Poder	PerPod	Em/In/Pr	standard	f	f
54	Subterfugio·Ataque	SubAta	Ag/Ad/In	standard	f	f
55	Subterfugio·Mecánica	SubMec	In/Ag/Ra	standard	f	f
56	Subterfugio·Sigilo	SubSig	Ag/Ad/In	standard	f	f
57	Técnica/Comercio·General	TecGen	Ra/Me/Ad	standard	f	f
58	Técnica/Comercio·Profesional	TecPro	Ra/Me/In	combined	f	f
59	Técnica/Comercio·Vocacional	TecVoc	Me/In/Ra	combined	f	f
60	Urbana	Urb	In/Pr/Ra	standard	f	f
\.


--
-- Data for Name: skills; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.skills (id, skill_category_id, name, code, description) FROM stdin;
1	ArdL	Cuero Endurecido (TA9; TA10; TA11)	cuero_endurecido_ta9_ta10_ta11	
2	ArdL	Cuero Blando (TA5; TA6; TA7)	cuero_blando_ta5_ta6_ta7	
3	ArdM	Cota de Mallas (TA13; TA14; TA15; TA16)	cota_de_mallas_ta13_ta14_ta15_ta16	
4	ArdP	Coraza (TA17; TA18; TA19; TA20)	coraza_ta17_ta18_ta19_ta20	
5	ArtA	Actuar	actuar	
6	ArtA	Bailar	bailar	
7	ArtA	Cantar	cantar	
8	ArtA	Imitar Sonidos	imitar_sonidos	
9	ArtA	Improvisación Poética	improvisacion_poetica	
10	ArtA	Mímica	mimica	
11	ArtA	Narrar Historias	narrar_historias	
12	ArtA	Tocar Instrumento	tocar_instrumento	
13	ArtA	Ventriloquia	ventriloquia	
14	ArtP	Escultura	escultura	
15	ArtP	Música	musica	
16	ArtP	Pintura	pintura	
17	ArtP	Poesía	poesia	
18	AmB	Barridos de Artes Marciales	barridos_de_artes_marciales	
19	AmB	Blocar	blocar	
20	AmB	Lucha Libre	lucha_libre	
21	AmB	Inmovilizar	inmovilizar	
22	AmG	Boxeo	boxeo	
23	AmG	Placaje	placaje	
24	AmG	Golpes de Artes Marciales	golpes_de_artes_marciales	
25	AmMC	Esquiva Adrenal	esquiva_adrenal	
26	AmMC	Evasión Adrenal	evasion_adrenal	
27	AtaEsp	Desarmar Enemigo (Armado)	desarmar_enemigo_armado	
28	AtaEsp	Desarmar Enemigo (Desarmado)	desarmar_enemigo_desarmado	
29	AtaEsp	Fintar (Armado)	fintar_armado	
30	AtaEsp	Fintar (Desarmado)	fintar_desarmado	
31	AtaEsp	Justar	justar	
32	AtaEsp	Pelea	pelea	
33	AtlG	Juegos Atléticos (Gimnasia)	juegos_atleticos_gimnasia	
34	AtlG	Acrobacias	acrobacias	
35	AtlG	Caer	caer	
36	AtlG	Contorsionismo	contorsionismo	
37	AtlG	Malabarismos	malabarismos	
38	AtlG	Trepar	trepar	
39	AtlG	Volar/Planear	volarplanear	
40	AtlG	Volteretas	volteretas	
41	AtlG	Caminar con Zancos	caminar_con_zancos	
42	AtlG	Caminar por la Cuerda Floja	caminar_por_la_cuerda_floja	
43	AtlG	Esquiar	esquiar	
44	AtlG	Hacer Surf	hacer_surf	
45	AtlG	Patinar	patinar	
46	AtlG	Rappelling	rappelling	
47	AtlG	Salto con Pértiga	salto_con_pertiga	
48	AtlP	Juegos Atléticos (Potencia)	juegos_atleticos_potencia	
49	AtlP	Levantar Pesos	levantar_pesos	
50	AtlP	Saltar	saltar	
51	AtlP	Golpe Poderoso	golpe_poderoso	
52	AtlP	Lanzamiento Poderoso	lanzamiento_poderoso	
53	AtlR	Juegos Atléticos (Resistencia)	juegos_atleticos_resistencia	
54	AtlR	Carrera de Fondo	carrera_de_fondo	
55	AtlR	Escalar	escalar	
56	AtlR	Esprintar	esprintar	
57	AtlR	Nadar	nadar	
58	AtlR	Remar	remar	
59	Autoc	Frenesí	frenesi	
60	Autoc	Meditación	meditacion	
61	Autoc	Mnemotecnia	mnemotecnia	
62	Autoc	Superar Aturdimiento	superar_aturdimiento	
63	Autoc	Caída Adrenal	caida_adrenal	
64	Autoc	Concentración Adrenal	concentracion_adrenal	
65	Autoc	Control de la Licantropía (R)	control_de_la_licantropia_r	
66	Autoc	Desenvainar Adrenal	desenvainar_adrenal	
67	Autoc	Equilibrio Adrenal	equilibrio_adrenal	
68	Autoc	Estabilización Adrenal (R)	estabilizacion_adrenal_r	
69	Autoc	Fuerza Adrenal	fuerza_adrenal	
70	Autoc	Maniobrar Aturdido	maniobrar_aturdido	
71	Autoc	Salto Adrenal	salto_adrenal	
72	Autoc	Trance Adormecedor	trance_adormecedor	
73	Autoc	Trance de la Muerte  (R)	trance_de_la_muerte_r	
74	Autoc	Trance Purificador  (R)	trance_purificador_r	
75	Autoc	Trance Sanador	trance_sanador	
76	Autoc	Velocidad Adrenal	velocidad_adrenal	
77	CienB	Documentación	documentacion	
78	CienB	Matemáticas Básicas	matematicas_basicas	
79	CienE	Alquimia	alquimia	
80	CienE	Antropología	antropologia	
81	CienE	Matemáticas Avanzadas	matematicas_avanzadas	
82	CienE	Astronomía	astronomia	
83	CienE	Bioquímica	bioquimica	
84	CienE	Psicología	psicologia	
85	CienE	Anatomía	anatomia	
86	Comun	Leer los Labios	leer_los_labios	
87	Comun	Señales	senales	
88	ConGen	Conocimiento de la Fauna	conocimiento_de_la_fauna	
89	ConGen	Conocimiento de la Flora	conocimiento_de_la_flora	
90	ConGen	Conocimiento Cultural	conocimiento_cultural	
91	ConGen	Conocimiento Regional	conocimiento_regional	
92	ConGen	Heráldica	heraldica	
93	ConGen	Historia	historia	
94	ConGen	Religión	religion	
95	ConGen	Conocimiento de Estilos Marciales	conocimiento_de_estilos_marciales	
96	ConGen	Conocimiento de Estilos de Armas	conocimiento_de_estilos_de_armas	
97	ConMag	Conocimiento de los Artefactos	conocimiento_de_los_artefactos	
98	ConMag	Conocimiento de los Hechizos	conocimiento_de_los_hechizos	
99	ConMag	Conocimiento de los No-Muertos	conocimiento_de_los_no_muertos	
100	ConMag	Conocimiento de las Protecciones	conocimiento_de_las_protecciones	
101	ConMag	Conocimiento de los Planos	conocimiento_de_los_planos	
102	ConMag	Conocimiento de los Símbolos	conocimiento_de_los_simbolos	
103	ConOsc	Conocimiento de las Hadas	conocimiento_de_las_hadas	
104	ConOsc	Conocimiento de los Dragones	conocimiento_de_los_dragones	
105	ConOsc	Demonología	demonologia	
106	ConOsc	Xeno-Conocimientos*	xeno_conocimientos	
107	ConTec	Conocimiento de la Piedra	conocimiento_de_la_piedra	
108	ConTec	Conocimiento de las Cerraduras	conocimiento_de_las_cerraduras	
109	ConTec	Conocimiento de las Hierbas	conocimiento_de_las_hierbas	
110	ConTec	Conocimiento de los Metales	conocimiento_de_los_metales	
111	ConTec	Conocimiento de los Venenos	conocimiento_de_los_venenos	
112	ConTec	Conocimiento del Comercio	conocimiento_del_comercio	
113	DefEsp	Aguante Adrenal	aguante_adrenal	
114	DefEsp	Defensa Adrenal	defensa_adrenal	
115	DefEsp	Resistencia Adrenal	resistencia_adrenal	
116	DesPP	Desarrollo de Puntos de Poder	desarrollo_de_puntos_de_poder	
117	DesFis	Desarrollo Físico	desarrollo_fisico	
118	ExtAni	Conducir	conducir	
119	ExtAni	Domar	domar	
120	ExtAni	Maestría de Animales (R)	maestria_de_animales_r	
121	ExtAni	Manejo de los Animales	manejo_de_los_animales	
122	ExtAni	Montar	montar	
123	ExtAni	Montar: Lobos	montar_lobos	
124	ExtAni	Montar: Caballos	montar_caballos	
125	ExtAni	Montar: Osos	montar_osos	
126	ExtAni	Montar: Camellos	montar_camellos	
127	ExtAni	Montar: Elefantes*	montar_elefantes	
128	ExtAni	Curación de Animales (R)	curacion_de_animales_r	
129	ExtAni	Pastoreo	pastoreo	
130	ExtEnt	Cazar	cazar	
131	ExtEnt	Espeleología	espeleologia	
132	ExtEnt	Forrajear	forrajear	
133	ExtEnt	Orientación Celeste	orientacion_celeste	
134	ExtEnt	Predicción del Clima	prediccion_del_clima	
135	ExtEnt	Supervivencia	supervivencia	
136	ExtEnt	Supervivencia (Montañas)	supervivencia_montanas	
137	ExtEnt	Supervivencia (Bosques)	supervivencia_bosques	
138	ExtEnt	Supervivencia (Desiertos)	supervivencia_desiertos	
139	ExtEnt	Supervivencia (Llanuras)	supervivencia_llanuras	
140	ExtEnt	Supervivencia (Subterráneos)	supervivencia_subterraneos	
141	ExtEnt	Supervivencia (Ártico)	supervivencia_artico	
142	HecDir	Relámpago	relampago	
143	HecDir	Rayo de agua	rayo_de_agua	
144	HecDir	Rayo de luz	rayo_de_luz	
145	HecDir	Rayo de fuego	rayo_de_fuego	
146	HecDir	Rayo de hielo	rayo_de_hielo	
147	Infl	Comerciar	comerciar	
148	Infl	Diplomacia	diplomacia	
149	Infl	Embaucar	embaucar	
150	Infl	Interrogar	interrogar	
151	Infl	Liderazgo	liderazgo	
152	Infl	Oratoria	oratoria	
153	Infl	Seducción	seduccion	
154	Infl	Sobornar	sobornar	
155	Infl	Rumorear	rumorear	
156	ManCom	Combate con 2 Armas	combate_con_2_armas	
157	ManCom	Combate Montado	combate_montado	
158	ManCom	Desenvainar	desenvainar	
159	ManCom	Florituras	florituras	
160	ManCom	Ataque de Revés	ataque_de_reves	
161	ManCom	Esquiva Acrobática (R)	esquiva_acrobatica_r	
162	ManCom	Estilo de Arma (Básico)	estilo_de_arma_basico	
163	ManCom	Estilo de Arma (Avanzado)	estilo_de_arma_avanzado	
164	ManCom	Subyugar	subyugar	
165	ManPod	Canalización	canalizacion	
166	ManPod	Maestría de los Hechizos	maestria_de_los_hechizos	
167	ManPod	Maestría de los Hechizos: Control del Aire	maestria_de_los_hechizos_control_del_aire	
168	ManPod	Maestría de los Hechizos: Ley de la Luz	maestria_de_los_hechizos_ley_de_la_luz	
169	ManPod	Maestría de los Hechizos: Maestría de los Espiritus	maestria_de_los_hechizos_maestria_de_los_espiritus	
170	ManPod	Ritual Mágico	ritual_magico	
171	ManPod	Ocultación de Hechizos	ocultacion_de_hechizos	
172	Ofi	Cocinar	cocinar	
173	Ofi	Manejo de Cuerdas	manejo_de_cuerdas	
174	Ofi	Trabajar el Cuero	trabajar_el_cuero	
175	Ofi	Trabajar el Metal	trabajar_el_metal	
176	Ofi	Trabajar la Madera	trabajar_la_madera	
177	Ofi	Trabajar la Piedra	trabajar_la_piedra	
178	Ofi	Coser/Tejer	cosertejer	
179	Ofi	Dibujar	dibujar	
180	Ofi	Escribir	escribir	
181	Ofi	Hacer Flechas	hacer_flechas	
182	Ofi	Horticultura	horticultura	
183	Ofi	Peletería	peleteria	
184	Ofi	Servicio	servicio	
185	Ofi	Trampero	trampero	
186	PerBus	Buscar	buscar	
187	PerBus	Detectar Mentiras	detectar_mentiras	
188	PerBus	Detectar Trampas	detectar_trampas	
189	PerBus	Detectar Venenos	detectar_venenos	
190	PerBus	Leer Huellas	leer_huellas	
191	PerBus	Observación	observacion	
192	PerBus	Rastrear	rastrear	
193	PerPers	Alerta	alerta	
194	PerPers	Detectar Emboscadas	detectar_emboscadas	
195	PerSen	Percepción del Entorno: Ciudades	percepcion_del_entorno_ciudades	
196	PerSen	Percepción del Entorno: Combate	percepcion_del_entorno_combate	
197	PerSen	Percepción del Entorno: Durmiendo	percepcion_del_entorno_durmiendo	
198	PerSen	Percepción del Entorno: Exploración	percepcion_del_entorno_exploracion	
199	PerSen	Sentido de la Dirección	sentido_de_la_direccion	
200	PerSen	Sentido del Espacio (R)	sentido_del_espacio_r	
201	PerSen	Sentido del Tiempo	sentido_del_tiempo	
202	PerSen	Vista	vista	
203	PerSen	Olfato	olfato	
204	PerSen	Gusto	gusto	
205	PerSen	Oído	oido	
206	PerSen	Tacto	tacto	
207	PerSen	Sentido de la Realidad (R)	sentido_de_la_realidad_r	
208	PerSen	Vigilancia	vigilancia	
209	PerPod	Leer Runas	leer_runas	
210	PerPod	Sintonización	sintonizacion	
211	PerPod	Adivinación	adivinacion	
212	PerPod	Percepción del Poder (R)	percepcion_del_poder_r	
213	SubAta	Ataque Silencioso	ataque_silencioso	
214	SubAta	Emboscar	emboscar	
215	SubMec	Abrir Cerraduras	abrir_cerraduras	
216	SubMec	Camuflaje	camuflaje	
217	SubMec	Desactivar Trampas	desactivar_trampas	
218	SubMec	Disfrazarse	disfrazarse	
219	SubMec	Construir Trampas	construir_trampas	
220	SubMec	Preparar Trampas	preparar_trampas	
221	SubMec	Usa/Curar Venenos	usacurar_venenos	
222	SubMec	Falsificación	falsificacion	
223	SubMec	Imitación	imitacion	
224	SubMec	Ocultar Objetos	ocultar_objetos	
225	SubSig	Acechar	acechar	
226	SubSig	Esconderse	esconderse	
227	SubSig	Juegos de Manos	juegos_de_manos	
228	SubSig	Robar Bolsillos	robar_bolsillos	
229	TecGen	Dibujar Mapas	dibujar_mapas	
230	TecGen	Juego	juego	
231	TecGen	Juegos de Estrategia	juegos_de_estrategia	
232	TecGen	Maquinaria	maquinaria	
233	TecGen	Mendigar	mendigar	
234	TecGen	Navegar	navegar	
235	TecGen	Orientación	orientacion	
236	TecGen	Primeros Auxilios	primeros_auxilios	
237	TecGen	Usar Hierbas	usar_hierbas	
238	TecPro	Cuidados Médicos	cuidados_medicos	
239	TecPro	Diagnosis	diagnosis	
240	TecPro	Ingeniería	ingenieria	
241	TecPro	Mecánica	mecanica	
242	TecPro	Minería	mineria	
243	TecPro	Adormecerse	adormecerse	
244	TecPro	Arquitectura	arquitectura	
245	TecPro	Cirugía	cirugia	
246	TecPro	Organización Militar	organizacion_militar	
247	TecPro	Propaganda	propaganda	
248	TecPro	Zahorí	zahori	
249	TecPro	Investigación	investigacion	
250	TecVoc	Administración	administracion	
251	TecVoc	Manejo de Botes	manejo_de_botes	
252	TecVoc	Evaluar Arma	evaluar_arma	
253	TecVoc	Evaluar Armadura	evaluar_armadura	
254	TecVoc	Evaluar Metal	evaluar_metal	
255	TecVoc	Evaluar Piedra	evaluar_piedra	
256	TecVoc	Navegación	navegacion	
257	TecVoc	Táctica	tactica	
258	TecVoc	Tasar	tasar	
259	TecVoc	Artimañas	artimanas	
260	TecVoc	Cartografía	cartografia	
261	TecVoc	Ingeniería de Asedio	ingenieria_de_asedio	
262	TecVoc	Partería	parteria	
263	TecVoc	Preparar Hierbas	preparar_hierbas	
264	TecVoc	Preparar Venenos	preparar_venenos	
265	Urb	Agenciar	agenciar	
266	Urb	Callejeo	callejeo	
267	Urb	Disimulo	disimulo	
268	Urb	Instinto Urbano	instinto_urbano	
\.


--
-- Data for Name: spell_list_dps; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.spell_list_dps (id, spell_user_type, own_realm, other_realm, is_editable) FROM stdin;
1	pure	{"basics":{"5":"3\\/3\\/3","10":"3\\/3\\/3","15":"3\\/3\\/3","20":"3\\/3\\/3","21":"3\\/3\\/3"},"open":{"5":"4\\/4\\/4","10":"4\\/4\\/4","15":"4\\/4\\/4","20":"4\\/4\\/4","21":"6\\/6\\/6"},"closed":{"5":"4\\/4\\/4","10":"4\\/4\\/4","15":"4\\/4\\/4","20":"4\\/4\\/4","21":"8\\/8"},"other":{"5":"8\\/8","10":"10\\/10","15":"12","20":"25","21":"40"},"training":{"5":"4\\/4\\/4","10":"4\\/4\\/4","15":"4\\/4\\/4","20":"4\\/4\\/4","21":"4\\/4\\/4"}}	{"open":{"5":"10\\/10","10":"12","15":"25","20":"40","21":"60"},"closed":{"5":"20","10":"25","15":"40","20":"60","21":"80"},"other":{"5":"50","10":"70","15":"90","20":"110","21":"130"},"training":{"5":"8\\/8\\/8","10":"8\\/8\\/8","15":"8\\/8\\/8","20":"8\\/8\\/8","21":"8\\/8\\/8"},"arcane":{"5":"6\\/6","10":"8\\/8","15":"10\\/10","20":"12","21":"25"}}	f
2	semi	{"basics":{"5":"6\\/6\\/6","10":"6\\/6\\/6","15":"6\\/6\\/6","20":"6\\/6\\/6","21":"6\\/6\\/6"},"open":{"5":"8\\/8","10":"8\\/8","15":"12","20":"18","21":"25"},"closed":{"5":"10\\/10","10":"12","15":"25","20":"40","21":"60"},"other":{"5":"25","10":"40","15":"60","20":"80","21":"100"},"training":{"5":"6\\/6\\/6","10":"6\\/6\\/6","15":"6\\/6\\/6","20":"6\\/6\\/6","21":"6\\/6\\/6"}}	{"open":{"5":"30","10":"60","15":"80","20":"100","21":"120"},"closed":{"5":"45","10":"60","15":"80","20":"100","21":"120"},"other":{"5":"80","10":"100","15":"120","20":"140","21":"160"},"training":{"5":"12\\/12","10":"12\\/12","15":"12\\/12","20":"12\\/12","21":"12\\/12"},"arcane":{"5":"12","10":"25","15":"40","20":"60","21":"80"}}	f
3	hybrid	{"basics":{"5":"3\\/3\\/3","10":"3\\/3\\/3","15":"3\\/3\\/3","20":"3\\/3\\/3","21":"3\\/3\\/3"},"open":{"5":"4\\/4\\/4","10":"4\\/4\\/4","15":"6\\/6\\/6","20":"8\\/8","21":"12"},"closed":{"5":"4\\/4\\/4","10":"6\\/6\\/6","15":"8\\/8","20":"10\\/10","21":"25"},"other":{"5":"10\\/10","10":"12","15":"25","20":"40","21":"60"},"training":{"5":"4\\/4\\/4","10":"4\\/4\\/4","15":"4\\/4\\/4","20":"4\\/4\\/4","21":"4\\/4\\/4"}}	{"open":{"5":"12","10":"25","15":"40","20":"60","21":"80"},"closed":{"5":"25","10":"40","15":"60","20":"80","21":"100"},"other":{"5":"60","10":"80","15":"100","20":"120","21":"140"},"training":{"5":"8\\/8\\/8","10":"8\\/8\\/8","15":"8\\/8\\/8","20":"8\\/8\\/8","21":"8\\/8\\/8"},"arcane":{"5":"5\\/5","10":"6\\/6","15":"8\\/8","20":"10\\/10","21":"12"}}	f
4	ladron	{"open":{"5":18,"10":36,"15":54,"20":72,"21":90},"closed":{"5":35,"10":70,"15":105,"20":140,"21":175},"other":{"5":70,"10":140,"15":210,"20":280,"21":350},"training":{"5":"8\\/8\\/8","10":"8\\/8\\/8","15":"8\\/8\\/8","20":"8\\/8\\/8","21":"8\\/8\\/8"}}	{"open":{"5":80,"10":160,"15":240,"20":320,"21":400},"closed":{"5":100,"10":200,"15":300,"20":400,"21":500},"other":{"5":70,"10":140,"15":210,"20":280,"21":350},"training":{"5":"16\\/16","10":"16\\/16","15":"16\\/16","20":"16\\/16","21":"16\\/16"},"arcane":{"5":22,"10":44,"15":66,"20":88,"21":110}}	f
5	luchador	{"open":{"5":25,"10":50,"15":75,"20":100,"21":125},"closed":{"5":40,"10":80,"15":120,"20":160,"21":200},"other":{"5":80,"10":160,"15":240,"20":320,"21":400},"training":{"5":"8\\/8\\/8","10":"8\\/8\\/8","15":"8\\/8\\/8","20":"8\\/8\\/8","21":"8\\/8\\/8"}}	{"open":{"5":90,"10":180,"15":270,"20":360,"21":450},"closed":{"5":105,"10":210,"15":315,"20":420,"21":525},"other":{"5":80,"10":160,"15":240,"20":320,"21":400},"training":{"5":"16\\/16","10":"16\\/16","15":"16\\/16","20":"16\\/16","21":"16\\/16"},"arcane":{"5":30,"10":60,"15":90,"20":120,"21":150}}	f
6	bribon	{"open":{"5":15,"10":30,"15":45,"20":60,"21":75},"closed":{"5":25,"10":50,"15":75,"20":100,"21":125},"other":{"5":50,"10":100,"15":150,"20":200,"21":250},"training":{"5":"8\\/8\\/8","10":"8\\/8\\/8","15":"8\\/8\\/8","20":"8\\/8\\/8","21":"8\\/8\\/8"}}	{"open":{"5":60,"10":120,"15":180,"20":240,"21":300},"closed":{"5":90,"10":180,"15":270,"20":360,"21":450},"other":{"5":50,"10":100,"15":150,"20":200,"21":250},"training":{"5":"16\\/16","10":"16\\/16","15":"16\\/16","20":"16\\/16","21":"16\\/16"},"arcane":{"5":20,"10":40,"15":60,"20":80,"21":100}}	f
7	monje_guerrero	{"open":{"5":20,"10":40,"15":60,"20":80,"21":100},"closed":{"5":30,"10":60,"15":90,"20":120,"21":150},"other":{"5":60,"10":120,"15":180,"20":240,"21":300},"training":{"5":"8\\/8\\/8","10":"8\\/8\\/8","15":"8\\/8\\/8","20":"8\\/8\\/8","21":"8\\/8\\/8"}}	{"open":{"5":70,"10":140,"15":210,"20":280,"21":350},"closed":{"5":105,"10":210,"15":315,"20":420,"21":525},"other":{"5":95,"10":190,"15":285,"20":380,"21":475},"training":{"5":"16\\/16","10":"16\\/16","15":"16\\/16","20":"16\\/16","21":"16\\/16"},"arcane":{"5":25,"10":50,"15":75,"20":100,"21":125}}	f
\.


--
-- Data for Name: spell_lists; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.spell_lists (id, created_at, updated_at, name, list_type, description, notes) FROM stdin;
1	\N	\N	Amplificaciones 2	basic	Los hechizos de esta lista sirven para bufar	
\.


--
-- Data for Name: spells; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.spells (id, created_at, updated_at, level, name, description, list_name, code, class, subclass, effect_area, duration, range, notes, list_id, searchtext) FROM stdin;
1	\N	\N	1	Memorizar	El lanzador memoriza una unica imagen que puede ser recordada en cualquier momento. Solo se puede memorizar una imagen por nivel del hechicero.	Amplificaciones	std	U	none	{"code":"SELF"}	{"code":"INS"}	{"code":"SELF"}		1	'amplif':25 'cualqui':13 'hechicer':24 'imag':7,20 'lanzador':3 'memoriz':1,4,18 'moment':14 'nivel':22 'pued':9,17 'record':11 'ser':10 'sol':15 'unic':6
2	\N	\N	3	Iniciativa V	El lanzador aumenta +5 a su tirada de iniciativa en el siguiente asalto	Amplificaciones	ins	U	none	{"code":"SELF"}	{"code":"TIME","unit":"rnd","amount":1}	{"code":"SELF"}		1	'+5':6 'amplif':16 'asalt':15 'aument':5 'inici':1,11 'lanzador':4 'siguient':14 'tir':9 'v':2
3	\N	\N	4	Lectura rapida II	El lanzador puede leer a un ritmo de 20 paginas por minuto	Amplificaciones	std	U	none	{"code":"SELF"}	{"code":"TIME_LVL","amount":10,"unit":"min"}	{"code":"SELF"}		1	'20':12 'amplif':16 'ii':3 'lanzador':5 'lectur':1 'leer':7 'minut':15 'pagin':13 'pued':6 'rap':2 'ritm':10
4	\N	\N	5	Mas rapido I	El objetivo puede actuar al doble de su ritmo	Amplificaciones	ins	U	none	{"code": "SELF"}	{"code": "TIME", "amount": 1, "unit": "rnd"}	{"code": "SELF"}	Ver seccion 7.1.24 de la Guia de los Hechizos para mas informacion	1	'actu':7 'amplif':13 'dobl':9 'i':3 'mas':1 'objet':5 'pued':6 'rap':2 'ritm':12
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: openrpg-master
--

COPY public.users (id, name, email, email_verified_at, password, api_token, remember_token, created_at, updated_at) FROM stdin;
1	admin	admin@test.com	\N	$2y$10$AVRcjlTBQL.AxsV2mfrBAuNxj34aBtGpG.PN674oS8DBSlPxj90TK	s7sfuasBzU4I6z0ZzVPgdSZIztkg0WFSWLtvQBbf2fV2x6R3jXerAYKtSdZr	KeeBytc7mrRxULBO9Kyl7855NFUyJkjbZJYDGMzxe0R5U3BjKo9XovAVNOjd	\N	\N
\.


--
-- Name: adventures_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.adventures_id_seq', 1, false);


--
-- Name: auth_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.auth_group_id_seq', 1, false);


--
-- Name: auth_group_permissions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.auth_group_permissions_id_seq', 1, false);


--
-- Name: auth_permission_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.auth_permission_id_seq', 32, true);


--
-- Name: auth_user_groups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.auth_user_groups_id_seq', 1, false);


--
-- Name: auth_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.auth_user_id_seq', 1, true);


--
-- Name: auth_user_user_permissions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.auth_user_user_permissions_id_seq', 1, false);


--
-- Name: bonus_profession_skill_category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.bonus_profession_skill_category_id_seq', 5, true);


--
-- Name: campaigns_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.campaigns_id_seq', 1, false);


--
-- Name: characters_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.characters_id_seq', 5, true);


--
-- Name: culture_skill_categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.culture_skill_categories_id_seq', 1, false);


--
-- Name: culture_skills_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.culture_skills_id_seq', 1, false);


--
-- Name: cultures_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.cultures_id_seq', 1, false);


--
-- Name: django_admin_log_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.django_admin_log_id_seq', 8, true);


--
-- Name: django_content_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.django_content_type_id_seq', 8, true);


--
-- Name: django_migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.django_migrations_id_seq', 18, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.migrations_id_seq', 182, true);


--
-- Name: professions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.professions_id_seq', 1, true);


--
-- Name: professions_skills_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.professions_skills_id_seq', 1, true);


--
-- Name: races_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.races_id_seq', 1, false);


--
-- Name: skill_categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.skill_categories_id_seq', 60, true);


--
-- Name: skills_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.skills_id_seq', 268, true);


--
-- Name: spell_list_dps_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.spell_list_dps_id_seq', 7, true);


--
-- Name: spell_lists_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.spell_lists_id_seq', 1, false);


--
-- Name: spells_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.spells_id_seq', 4, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: openrpg-master
--

SELECT pg_catalog.setval('public.users_id_seq', 1, true);


--
-- Name: adventures adventures_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.adventures
    ADD CONSTRAINT adventures_pkey PRIMARY KEY (id);


--
-- Name: auth_group auth_group_name_key; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_group
    ADD CONSTRAINT auth_group_name_key UNIQUE (name);


--
-- Name: auth_group_permissions auth_group_permissions_group_id_permission_id_0cd325b0_uniq; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_group_permissions
    ADD CONSTRAINT auth_group_permissions_group_id_permission_id_0cd325b0_uniq UNIQUE (group_id, permission_id);


--
-- Name: auth_group_permissions auth_group_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_group_permissions
    ADD CONSTRAINT auth_group_permissions_pkey PRIMARY KEY (id);


--
-- Name: auth_group auth_group_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_group
    ADD CONSTRAINT auth_group_pkey PRIMARY KEY (id);


--
-- Name: auth_permission auth_permission_content_type_id_codename_01ab375a_uniq; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_permission
    ADD CONSTRAINT auth_permission_content_type_id_codename_01ab375a_uniq UNIQUE (content_type_id, codename);


--
-- Name: auth_permission auth_permission_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_permission
    ADD CONSTRAINT auth_permission_pkey PRIMARY KEY (id);


--
-- Name: auth_user_groups auth_user_groups_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_user_groups
    ADD CONSTRAINT auth_user_groups_pkey PRIMARY KEY (id);


--
-- Name: auth_user_groups auth_user_groups_user_id_group_id_94350c0c_uniq; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_user_groups
    ADD CONSTRAINT auth_user_groups_user_id_group_id_94350c0c_uniq UNIQUE (user_id, group_id);


--
-- Name: auth_user auth_user_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_user
    ADD CONSTRAINT auth_user_pkey PRIMARY KEY (id);


--
-- Name: auth_user_user_permissions auth_user_user_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_user_user_permissions
    ADD CONSTRAINT auth_user_user_permissions_pkey PRIMARY KEY (id);


--
-- Name: auth_user_user_permissions auth_user_user_permissions_user_id_permission_id_14a6b632_uniq; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_user_user_permissions
    ADD CONSTRAINT auth_user_user_permissions_user_id_permission_id_14a6b632_uniq UNIQUE (user_id, permission_id);


--
-- Name: auth_user auth_user_username_key; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_user
    ADD CONSTRAINT auth_user_username_key UNIQUE (username);


--
-- Name: bonus_profession_skill_category bonus_profession_skill_category_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.bonus_profession_skill_category
    ADD CONSTRAINT bonus_profession_skill_category_pkey PRIMARY KEY (id);


--
-- Name: campaigns campaigns_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.campaigns
    ADD CONSTRAINT campaigns_pkey PRIMARY KEY (id);


--
-- Name: characters characters_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.characters
    ADD CONSTRAINT characters_pkey PRIMARY KEY (id);


--
-- Name: culture_skill_categories culture_skill_categories_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.culture_skill_categories
    ADD CONSTRAINT culture_skill_categories_pkey PRIMARY KEY (id);


--
-- Name: culture_skills culture_skills_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.culture_skills
    ADD CONSTRAINT culture_skills_pkey PRIMARY KEY (id);


--
-- Name: cultures cultures_name_unique; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.cultures
    ADD CONSTRAINT cultures_name_unique UNIQUE (name);


--
-- Name: cultures cultures_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.cultures
    ADD CONSTRAINT cultures_pkey PRIMARY KEY (id);


--
-- Name: django_admin_log django_admin_log_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.django_admin_log
    ADD CONSTRAINT django_admin_log_pkey PRIMARY KEY (id);


--
-- Name: django_content_type django_content_type_app_label_model_76bd3d3b_uniq; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.django_content_type
    ADD CONSTRAINT django_content_type_app_label_model_76bd3d3b_uniq UNIQUE (app_label, model);


--
-- Name: django_content_type django_content_type_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.django_content_type
    ADD CONSTRAINT django_content_type_pkey PRIMARY KEY (id);


--
-- Name: django_migrations django_migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.django_migrations
    ADD CONSTRAINT django_migrations_pkey PRIMARY KEY (id);


--
-- Name: django_session django_session_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.django_session
    ADD CONSTRAINT django_session_pkey PRIMARY KEY (session_key);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: professions professions_code_unique; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.professions
    ADD CONSTRAINT professions_code_unique UNIQUE (code);


--
-- Name: professions professions_name_unique; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.professions
    ADD CONSTRAINT professions_name_unique UNIQUE (name);


--
-- Name: professions professions_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.professions
    ADD CONSTRAINT professions_pkey PRIMARY KEY (id);


--
-- Name: professions_skills professions_skills_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.professions_skills
    ADD CONSTRAINT professions_skills_pkey PRIMARY KEY (id);


--
-- Name: races races_name_unique; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.races
    ADD CONSTRAINT races_name_unique UNIQUE (name);


--
-- Name: races races_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.races
    ADD CONSTRAINT races_pkey PRIMARY KEY (id);


--
-- Name: skill_categories skill_categories_code_unique; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.skill_categories
    ADD CONSTRAINT skill_categories_code_unique UNIQUE (code);


--
-- Name: skill_categories skill_categories_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.skill_categories
    ADD CONSTRAINT skill_categories_pkey PRIMARY KEY (id);


--
-- Name: skills skills_code_unique; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.skills
    ADD CONSTRAINT skills_code_unique UNIQUE (code);


--
-- Name: skills skills_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.skills
    ADD CONSTRAINT skills_pkey PRIMARY KEY (id);


--
-- Name: spell_list_dps spell_list_dps_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.spell_list_dps
    ADD CONSTRAINT spell_list_dps_pkey PRIMARY KEY (id);


--
-- Name: spell_list_dps spell_list_dps_spell_user_type_unique; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.spell_list_dps
    ADD CONSTRAINT spell_list_dps_spell_user_type_unique UNIQUE (spell_user_type);


--
-- Name: spell_lists spell_lists_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.spell_lists
    ADD CONSTRAINT spell_lists_pkey PRIMARY KEY (id);


--
-- Name: spells spells_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.spells
    ADD CONSTRAINT spells_pkey PRIMARY KEY (id);


--
-- Name: users users_api_token_unique; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_api_token_unique UNIQUE (api_token);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: auth_group_name_a6ea08ec_like; Type: INDEX; Schema: public; Owner: openrpg-master
--

CREATE INDEX auth_group_name_a6ea08ec_like ON public.auth_group USING btree (name varchar_pattern_ops);


--
-- Name: auth_group_permissions_group_id_b120cbf9; Type: INDEX; Schema: public; Owner: openrpg-master
--

CREATE INDEX auth_group_permissions_group_id_b120cbf9 ON public.auth_group_permissions USING btree (group_id);


--
-- Name: auth_group_permissions_permission_id_84c5c92e; Type: INDEX; Schema: public; Owner: openrpg-master
--

CREATE INDEX auth_group_permissions_permission_id_84c5c92e ON public.auth_group_permissions USING btree (permission_id);


--
-- Name: auth_permission_content_type_id_2f476e4b; Type: INDEX; Schema: public; Owner: openrpg-master
--

CREATE INDEX auth_permission_content_type_id_2f476e4b ON public.auth_permission USING btree (content_type_id);


--
-- Name: auth_user_groups_group_id_97559544; Type: INDEX; Schema: public; Owner: openrpg-master
--

CREATE INDEX auth_user_groups_group_id_97559544 ON public.auth_user_groups USING btree (group_id);


--
-- Name: auth_user_groups_user_id_6a12ed8b; Type: INDEX; Schema: public; Owner: openrpg-master
--

CREATE INDEX auth_user_groups_user_id_6a12ed8b ON public.auth_user_groups USING btree (user_id);


--
-- Name: auth_user_user_permissions_permission_id_1fbb5f2c; Type: INDEX; Schema: public; Owner: openrpg-master
--

CREATE INDEX auth_user_user_permissions_permission_id_1fbb5f2c ON public.auth_user_user_permissions USING btree (permission_id);


--
-- Name: auth_user_user_permissions_user_id_a95ead1b; Type: INDEX; Schema: public; Owner: openrpg-master
--

CREATE INDEX auth_user_user_permissions_user_id_a95ead1b ON public.auth_user_user_permissions USING btree (user_id);


--
-- Name: auth_user_username_6821ab7c_like; Type: INDEX; Schema: public; Owner: openrpg-master
--

CREATE INDEX auth_user_username_6821ab7c_like ON public.auth_user USING btree (username varchar_pattern_ops);


--
-- Name: django_admin_log_content_type_id_c4bce8eb; Type: INDEX; Schema: public; Owner: openrpg-master
--

CREATE INDEX django_admin_log_content_type_id_c4bce8eb ON public.django_admin_log USING btree (content_type_id);


--
-- Name: django_admin_log_user_id_c564eba6; Type: INDEX; Schema: public; Owner: openrpg-master
--

CREATE INDEX django_admin_log_user_id_c564eba6 ON public.django_admin_log USING btree (user_id);


--
-- Name: django_session_expire_date_a5c62663; Type: INDEX; Schema: public; Owner: openrpg-master
--

CREATE INDEX django_session_expire_date_a5c62663 ON public.django_session USING btree (expire_date);


--
-- Name: django_session_session_key_c0390e0f_like; Type: INDEX; Schema: public; Owner: openrpg-master
--

CREATE INDEX django_session_session_key_c0390e0f_like ON public.django_session USING btree (session_key varchar_pattern_ops);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: openrpg-master
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: searchtext_gin; Type: INDEX; Schema: public; Owner: openrpg-master
--

CREATE INDEX searchtext_gin ON public.spells USING gin (searchtext);


--
-- Name: spells ts_searchtext; Type: TRIGGER; Schema: public; Owner: openrpg-master
--

CREATE TRIGGER ts_searchtext BEFORE INSERT OR UPDATE ON public.spells FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('searchtext', 'pg_catalog.spanish', 'name', 'description', 'list_name');


--
-- Name: auth_group_permissions auth_group_permissio_permission_id_84c5c92e_fk_auth_perm; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_group_permissions
    ADD CONSTRAINT auth_group_permissio_permission_id_84c5c92e_fk_auth_perm FOREIGN KEY (permission_id) REFERENCES public.auth_permission(id) DEFERRABLE INITIALLY DEFERRED;


--
-- Name: auth_group_permissions auth_group_permissions_group_id_b120cbf9_fk_auth_group_id; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_group_permissions
    ADD CONSTRAINT auth_group_permissions_group_id_b120cbf9_fk_auth_group_id FOREIGN KEY (group_id) REFERENCES public.auth_group(id) DEFERRABLE INITIALLY DEFERRED;


--
-- Name: auth_permission auth_permission_content_type_id_2f476e4b_fk_django_co; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_permission
    ADD CONSTRAINT auth_permission_content_type_id_2f476e4b_fk_django_co FOREIGN KEY (content_type_id) REFERENCES public.django_content_type(id) DEFERRABLE INITIALLY DEFERRED;


--
-- Name: auth_user_groups auth_user_groups_group_id_97559544_fk_auth_group_id; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_user_groups
    ADD CONSTRAINT auth_user_groups_group_id_97559544_fk_auth_group_id FOREIGN KEY (group_id) REFERENCES public.auth_group(id) DEFERRABLE INITIALLY DEFERRED;


--
-- Name: auth_user_groups auth_user_groups_user_id_6a12ed8b_fk_auth_user_id; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_user_groups
    ADD CONSTRAINT auth_user_groups_user_id_6a12ed8b_fk_auth_user_id FOREIGN KEY (user_id) REFERENCES public.auth_user(id) DEFERRABLE INITIALLY DEFERRED;


--
-- Name: auth_user_user_permissions auth_user_user_permi_permission_id_1fbb5f2c_fk_auth_perm; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_user_user_permissions
    ADD CONSTRAINT auth_user_user_permi_permission_id_1fbb5f2c_fk_auth_perm FOREIGN KEY (permission_id) REFERENCES public.auth_permission(id) DEFERRABLE INITIALLY DEFERRED;


--
-- Name: auth_user_user_permissions auth_user_user_permissions_user_id_a95ead1b_fk_auth_user_id; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.auth_user_user_permissions
    ADD CONSTRAINT auth_user_user_permissions_user_id_a95ead1b_fk_auth_user_id FOREIGN KEY (user_id) REFERENCES public.auth_user(id) DEFERRABLE INITIALLY DEFERRED;


--
-- Name: bonus_profession_skill_category bonus_profession_skill_category_profession_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.bonus_profession_skill_category
    ADD CONSTRAINT bonus_profession_skill_category_profession_id_foreign FOREIGN KEY (profession_id) REFERENCES public.professions(code) ON DELETE CASCADE;


--
-- Name: bonus_profession_skill_category bonus_profession_skill_category_skill_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.bonus_profession_skill_category
    ADD CONSTRAINT bonus_profession_skill_category_skill_category_id_foreign FOREIGN KEY (skill_category_id) REFERENCES public.skill_categories(code) ON DELETE CASCADE;


--
-- Name: characters characters_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.characters
    ADD CONSTRAINT characters_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id);


--
-- Name: django_admin_log django_admin_log_content_type_id_c4bce8eb_fk_django_co; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.django_admin_log
    ADD CONSTRAINT django_admin_log_content_type_id_c4bce8eb_fk_django_co FOREIGN KEY (content_type_id) REFERENCES public.django_content_type(id) DEFERRABLE INITIALLY DEFERRED;


--
-- Name: django_admin_log django_admin_log_user_id_c564eba6_fk_auth_user_id; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.django_admin_log
    ADD CONSTRAINT django_admin_log_user_id_c564eba6_fk_auth_user_id FOREIGN KEY (user_id) REFERENCES public.auth_user(id) DEFERRABLE INITIALLY DEFERRED;


--
-- Name: professions_skills professions_skills_profession_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.professions_skills
    ADD CONSTRAINT professions_skills_profession_id_foreign FOREIGN KEY (profession_id) REFERENCES public.professions(code) ON DELETE CASCADE;


--
-- Name: professions_skills professions_skills_skill_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.professions_skills
    ADD CONSTRAINT professions_skills_skill_id_foreign FOREIGN KEY (skill_id) REFERENCES public.skills(code) ON DELETE CASCADE;


--
-- Name: skills skills_skill_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.skills
    ADD CONSTRAINT skills_skill_category_id_foreign FOREIGN KEY (skill_category_id) REFERENCES public.skill_categories(code) ON DELETE CASCADE;


--
-- Name: spells spells_list_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: openrpg-master
--

ALTER TABLE ONLY public.spells
    ADD CONSTRAINT spells_list_id_foreign FOREIGN KEY (list_id) REFERENCES public.spell_lists(id) ON DELETE SET NULL;


--
-- PostgreSQL database dump complete
--

--
-- PostgreSQL database dump
--

-- Dumped from database version 11.6 (Debian 11.6-1.pgdg90+1)
-- Dumped by pg_dump version 11.6 (Debian 11.6-1.pgdg90+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE postgres;
--
-- Name: postgres; Type: DATABASE; Schema: -; Owner: openrpg-master
--

CREATE DATABASE postgres WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.utf8' LC_CTYPE = 'en_US.utf8';


ALTER DATABASE postgres OWNER TO "openrpg-master";

\connect postgres

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: DATABASE postgres; Type: COMMENT; Schema: -; Owner: openrpg-master
--

COMMENT ON DATABASE postgres IS 'default administrative connection database';


--
-- PostgreSQL database dump complete
--

--
-- PostgreSQL database cluster dump complete
--

