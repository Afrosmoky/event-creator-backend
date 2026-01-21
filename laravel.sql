--
-- PostgreSQL database dump
--

-- Dumped from database version 17.2
-- Dumped by pg_dump version 17.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: cache; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO laravel;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO laravel;

--
-- Name: element_configs; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.element_configs (
    id uuid NOT NULL,
    element_id uuid NOT NULL,
    type character varying(255),
    seats character varying(255),
    radius character varying(255),
    width double precision,
    height double precision,
    size double precision,
    angle double precision,
    angle_origin_x double precision,
    angle_origin_y double precision,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.element_configs OWNER TO laravel;

--
-- Name: elements; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.elements (
    id uuid NOT NULL,
    name character varying(255) NOT NULL,
    ballroom_id integer NOT NULL,
    parent_id integer,
    x double precision NOT NULL,
    y double precision NOT NULL,
    color character varying(255),
    kind character varying(255) NOT NULL,
    spacing double precision NOT NULL,
    status character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.elements OWNER TO laravel;

--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO laravel;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO laravel;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: guests; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.guests (
    id uuid NOT NULL,
    guest_id character varying(255) NOT NULL,
    element_id uuid NOT NULL,
    ballroom_id integer NOT NULL,
    seated bool NOT NULL,
    group character varying(255),
    parameters jsonb
);


ALTER TABLE public.guests OWNER TO laravel;

--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO laravel;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO laravel;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO laravel;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO laravel;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO laravel;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: oauth_access_tokens; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.oauth_access_tokens (
    id character varying(100) NOT NULL,
    user_id bigint,
    client_id bigint NOT NULL,
    name character varying(255),
    scopes text,
    revoked boolean NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone
);


ALTER TABLE public.oauth_access_tokens OWNER TO laravel;

--
-- Name: oauth_auth_codes; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.oauth_auth_codes (
    id character varying(100) NOT NULL,
    user_id bigint NOT NULL,
    client_id bigint NOT NULL,
    scopes text,
    revoked boolean NOT NULL,
    expires_at timestamp(0) without time zone
);


ALTER TABLE public.oauth_auth_codes OWNER TO laravel;

--
-- Name: oauth_clients; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.oauth_clients (
    id bigint NOT NULL,
    user_id bigint,
    name character varying(255) NOT NULL,
    secret character varying(100),
    provider character varying(255),
    redirect text NOT NULL,
    personal_access_client boolean NOT NULL,
    password_client boolean NOT NULL,
    revoked boolean NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.oauth_clients OWNER TO laravel;

--
-- Name: oauth_clients_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.oauth_clients_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.oauth_clients_id_seq OWNER TO laravel;

--
-- Name: oauth_clients_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.oauth_clients_id_seq OWNED BY public.oauth_clients.id;


--
-- Name: oauth_personal_access_clients; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.oauth_personal_access_clients (
    id bigint NOT NULL,
    client_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.oauth_personal_access_clients OWNER TO laravel;

--
-- Name: oauth_personal_access_clients_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.oauth_personal_access_clients_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.oauth_personal_access_clients_id_seq OWNER TO laravel;

--
-- Name: oauth_personal_access_clients_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.oauth_personal_access_clients_id_seq OWNED BY public.oauth_personal_access_clients.id;


--
-- Name: oauth_refresh_tokens; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.oauth_refresh_tokens (
    id character varying(100) NOT NULL,
    access_token_id character varying(100) NOT NULL,
    revoked boolean NOT NULL,
    expires_at timestamp(0) without time zone
);


ALTER TABLE public.oauth_refresh_tokens OWNER TO laravel;

--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO laravel;

--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO laravel;

'gender',
        'age_group',
        'menu',
        'seated',
        'group',

ALTER TABLE public.guests
    ADD gender VARCHAR(255);
ALTER TABLE public.guests
    ADD menu VARCHAR(255);
ALTER TABLE public.guests
    ADD seated boolean;
ALTER TABLE public.guests
    ADD "group" VARCHAR(255);
ALTER TABLE public.elements
    ADD "type" VARCHAR(255);
ALTER TABLE public.element_configs
    DROP COLUMN "type";


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.personal_access_tokens_id_seq OWNER TO laravel;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: products; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.products (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.products OWNER TO laravel;

--
-- Name: products_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.products_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.products_id_seq OWNER TO laravel;

--
-- Name: products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.products_id_seq OWNED BY public.products.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO laravel;

--
-- Name: users; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO laravel;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO laravel;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: oauth_clients id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.oauth_clients ALTER COLUMN id SET DEFAULT nextval('public.oauth_clients_id_seq'::regclass);


--
-- Name: oauth_personal_access_clients id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.oauth_personal_access_clients ALTER COLUMN id SET DEFAULT nextval('public.oauth_personal_access_clients_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: products id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.products ALTER COLUMN id SET DEFAULT nextval('public.products_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: element_configs; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.element_configs (id, element_id, type, seats, radius, width, height, size, angle, angle_origin_x, angle_origin_y, created_at, updated_at) FROM stdin;
9e5def46-c72a-41b3-8fce-2fff436f51a9	9e5def46-c307-49ee-91f3-a310da22826f	\N	\N	\N	\N	\N	\N	\N	\N	\N	2025-03-06 12:07:15	2025-03-06 12:07:15
9e5defc3-db9d-4469-932e-a61c30240705	9e5defc3-daa7-4638-b1df-a530a462f9e2	rectangle	\N	12	\N	\N	\N	\N	\N	\N	2025-03-06 12:08:37	2025-03-06 12:08:37
\.


--
-- Data for Name: elements; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.elements (id, name, ballroom_id, parent_id, x, y, color, kind, spacing, status, created_at, updated_at) FROM stdin;
9e5def46-c307-49ee-91f3-a310da22826f	Chair	10	\N	23.456	21.856	red	chair	4.5	active	2025-03-06 12:07:15	2025-03-06 12:07:15
9e5defc3-daa7-4638-b1df-a530a462f9e2	Chair	10	\N	23.456	21.856	red	chair	4.5	active	2025-03-06 12:08:37	2025-03-06 12:08:37
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: guests; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.guests (id, guest_id, element_id, ballroom_id, parameters) FROM stdin;
9e5e0195-8ea9-4863-ba36-dfdf8237663d	1	9e5def46-c307-49ee-91f3-a310da22826f	1	\N
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
11	2025_02_18_115804_create_elements_table	2
17	2025_02_20_121633_create_oauth_auth_codes_table	3
18	2025_02_20_121634_create_oauth_access_tokens_table	3
19	2025_02_20_121635_create_oauth_refresh_tokens_table	3
20	2025_02_20_121636_create_oauth_clients_table	3
21	2025_02_20_121637_create_oauth_personal_access_clients_table	3
22	2025_02_20_130239_create_personal_access_tokens_table	3
23	2025_02_20_205719_create_products_table	4
\.


--
-- Data for Name: oauth_access_tokens; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.oauth_access_tokens (id, user_id, client_id, name, scopes, revoked, created_at, updated_at, expires_at) FROM stdin;
\.


--
-- Data for Name: oauth_auth_codes; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.oauth_auth_codes (id, user_id, client_id, scopes, revoked, expires_at) FROM stdin;
\.


--
-- Data for Name: oauth_clients; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.oauth_clients (id, user_id, name, secret, provider, redirect, personal_access_client, password_client, revoked, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: oauth_personal_access_clients; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.oauth_personal_access_clients (id, client_id, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: oauth_refresh_tokens; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.oauth_refresh_tokens (id, access_token_id, revoked, expires_at) FROM stdin;
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
1	App\\Models\\User	3	EmkaApp	d36206b5e08d0321d56b6a81d9408d80ce9d790f5076c2d795b149116a59f757	["*"]	\N	\N	2025-03-06 10:47:26	2025-03-06 10:47:26
2	App\\Models\\User	3	EmkaApp	bb29e6a4ac698bed008c1938771580a8c94b52958af180d2193e19f469ef44c1	["*"]	2025-03-06 13:06:52	\N	2025-03-06 10:50:02	2025-03-06 13:06:52
\.


--
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.products (id, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
jKU8SQwCwdTLAyQNSxr6oIvVt8B4NiCwpF7Q5zp1	\N	127.0.0.1	Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.1 Safari/605.1.15	YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHpabDdXUTc1SEJSemNxU0VWYzgwNjRLNU1BS2NlNUk0Y3YzZFFNWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1740481910
P1itZxDxqm6ei1ax1U7fjvGm1eyDxSxi3qVzuZAA	\N	127.0.0.1	Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.1 Safari/605.1.15	YTozOntzOjY6Il90b2tlbiI7czo0MDoiZzJ3UlN4dUJtY2JBdG4ybVFWN0lrd2NTS3VodXB0TzY0a0tLSmJFNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1740482622
X8GVdOuKXzPkQHugrvxrSVZCwmmc2Z3psNbJug2y	\N	127.0.0.1	PostmanRuntime/7.43.0	YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZmNDNnFFSEtnQkFxRUVxanNWenM2OWpZbVVGZlZ2b3IxOHVyTWxHRyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZW1rYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1740486154
h16SNkrPVlWubNIJbneEIECTlLsGhsrKambUsAIt	\N	127.0.0.1	PostmanRuntime/7.43.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1hJZlVhUThmWFc0MHBNTGplcWxMQWZlbDN4UUFybUpRNXRucUMzVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ndWVzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1740759964
yPPK8piowzm387qsTcFh4KfVZXP314uqjkJ8MwCM	\N	127.0.0.1	PostmanRuntime/7.43.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiTGE0QjluV2ZRUmwyT0ZZYjZiVEd4TTYzVjFSaFdCUnJMTXJxRUdiMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zYW5jdHVtL2NzcmYtY29va2llIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1740779461
0yszPVhszjilweyWQEqNY3bi0pBtzpdSNLuy1P5q	\N	127.0.0.1	Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.1 Safari/605.1.15	YTozOntzOjY6Il90b2tlbiI7czo0MDoiMlNNQWhIVXlqYWxieENvZ2xtVUhaR1Z1UVphaERwQmUwQ1VidmFsYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1741092886
GJSIyBJUD9qdrkve6c773SPdYml6m8y2afN1mlnl	1	127.0.0.1	Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.1 Safari/605.1.15	YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVGFXOUduMTFva09jZk5ZWkdRa2xZQmx6clNjRjN2QnNKWDZiN21MNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wcm9maWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9	1741093046
IZ5AOOrnSOa8mKNphP43zd3WXEpbDI0xKLk4DkRz	\N	127.0.0.1	PostmanRuntime/7.43.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUJHeXVCWlpDUGtwVjVSdE9BRUFSOEpjVVZHY01rMzZCOHAwUnZydiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1741093603
vvUVUU1B4ruRpptcFGmiUsQGXulvir9q7bDDPCc1	\N	127.0.0.1	Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3 Safari/605.1.15	YTozOntzOjY6Il90b2tlbiI7czo0MDoiTXFQU0RGQkN5YzlFUTRZQzZ5YlhVSWV6a2dZUUJhaVc5M1FCcGsxVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1741275075
A7617xTxXWXuuesXG75FHGwixuBbcI1u6MQymcQj	\N	127.0.0.1	Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3 Safari/605.1.15	YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVzM5UDRXaTIxUlA1amloRGNuOFhFcmduclhWNzhsRFdoT0t2TUtGdyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyOToiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3Byb2ZpbGUiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyOToiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3Byb2ZpbGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19	1742388324
SErj7SmLqQyojfp2R9ZRIO9MwhKI0bx7Q36UpC8R	\N	127.0.0.1	Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3 Safari/605.1.15	YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2hyakFhaXZ0YmJ0NHdUbUZDT3V6dzU1U1plSzJQNkJIZ1IyajJVNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1742417168
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
3	Piotr Szulc	szulcpiotr@icloud.com	\N	$2y$12$hJJJSwvY33uhV3FGavwb3eOCF6t1iU8R/1BzYnSf5ExkvXbkWprbK	\N	2025-03-06 10:47:26	2025-03-06 10:47:26
\.


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.migrations_id_seq', 23, true);


--
-- Name: oauth_clients_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.oauth_clients_id_seq', 1, false);


--
-- Name: oauth_personal_access_clients_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.oauth_personal_access_clients_id_seq', 1, false);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 2, true);


--
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.products_id_seq', 1, false);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.users_id_seq', 3, true);


--
-- Name: guests Element; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.guests
    ADD CONSTRAINT "Element" UNIQUE (element_id);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: element_configs element_configs_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.element_configs
    ADD CONSTRAINT element_configs_pkey PRIMARY KEY (id);


--
-- Name: elements elements_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.elements
    ADD CONSTRAINT elements_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: guests guests_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.guests
    ADD CONSTRAINT guests_pkey PRIMARY KEY (id);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: oauth_access_tokens oauth_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.oauth_access_tokens
    ADD CONSTRAINT oauth_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: oauth_auth_codes oauth_auth_codes_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.oauth_auth_codes
    ADD CONSTRAINT oauth_auth_codes_pkey PRIMARY KEY (id);


--
-- Name: oauth_clients oauth_clients_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.oauth_clients
    ADD CONSTRAINT oauth_clients_pkey PRIMARY KEY (id);


--
-- Name: oauth_personal_access_clients oauth_personal_access_clients_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.oauth_personal_access_clients
    ADD CONSTRAINT oauth_personal_access_clients_pkey PRIMARY KEY (id);


--
-- Name: oauth_refresh_tokens oauth_refresh_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.oauth_refresh_tokens
    ADD CONSTRAINT oauth_refresh_tokens_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: elements_ballroom_id_index; Type: INDEX; Schema: public; Owner: laravel
--

CREATE INDEX elements_ballroom_id_index ON public.elements USING btree (ballroom_id);


--
-- Name: elements_parent_id_index; Type: INDEX; Schema: public; Owner: laravel
--

CREATE INDEX elements_parent_id_index ON public.elements USING btree (parent_id);


--
-- Name: guests_ballroom_id_index; Type: INDEX; Schema: public; Owner: laravel
--

CREATE INDEX guests_ballroom_id_index ON public.guests USING btree (ballroom_id);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: laravel
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: oauth_access_tokens_user_id_index; Type: INDEX; Schema: public; Owner: laravel
--

CREATE INDEX oauth_access_tokens_user_id_index ON public.oauth_access_tokens USING btree (user_id);


--
-- Name: oauth_auth_codes_user_id_index; Type: INDEX; Schema: public; Owner: laravel
--

CREATE INDEX oauth_auth_codes_user_id_index ON public.oauth_auth_codes USING btree (user_id);


--
-- Name: oauth_clients_user_id_index; Type: INDEX; Schema: public; Owner: laravel
--

CREATE INDEX oauth_clients_user_id_index ON public.oauth_clients USING btree (user_id);


--
-- Name: oauth_refresh_tokens_access_token_id_index; Type: INDEX; Schema: public; Owner: laravel
--

CREATE INDEX oauth_refresh_tokens_access_token_id_index ON public.oauth_refresh_tokens USING btree (access_token_id);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: laravel
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: laravel
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: laravel
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: element_configs element_configs_element_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.element_configs
    ADD CONSTRAINT element_configs_element_id_foreign FOREIGN KEY (element_id) REFERENCES public.elements(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: guests guests_element_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.guests
    ADD CONSTRAINT guests_element_id_foreign FOREIGN KEY (element_id) REFERENCES public.elements(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

