-- 产品表

-- ALTER TABLE ec_product DROP COLUMN recommended_rating;

ALTER TABLE ec_product ADD COLUMN recommended_rating integer;
ALTER TABLE ec_product ALTER COLUMN recommended_rating SET DEFAULT 0;
COMMENT ON COLUMN ec_product.recommended_rating IS '推荐等级，0：不推荐，1：推荐到列表页，2：推荐到首页（列表页也能得到）';
  
--文章表
-- ALTER TABLE ec_article DROP COLUMN is_recommend;
ALTER TABLE ec_article ADD COLUMN is_recommend integer;
ALTER TABLE ec_article ALTER COLUMN is_recommend SET DEFAULT 0;
COMMENT ON COLUMN ec_article.is_recommend IS '是否推荐到首页
1：推荐，0：不推荐';
-- ALTER TABLE ec_article DROP COLUMN pic_url;

ALTER TABLE ec_article ADD COLUMN pic_url character(200);
COMMENT ON COLUMN ec_article.pic_url IS '图片地址';

-- 品牌表
  
-- ALTER TABLE ec_brand DROP COLUMN is_recommend;

ALTER TABLE ec_brand ADD COLUMN is_recommend integer;
ALTER TABLE ec_brand ALTER COLUMN is_recommend SET DEFAULT 0;
COMMENT ON COLUMN ec_brand.is_recommend IS '是否推荐';


--
-- Table: ec_zw_ad

-- DROP TABLE ec_zw_ad;

CREATE TABLE ec_zw_ad
(
  id serial NOT NULL, -- 自增长编号
  pic_url character(200), -- 图片地址
  link_url character(200), -- 链接跳转地址
  "position" integer DEFAULT 0, -- 排序编号
  pub_flg integer DEFAULT 1, -- 是否发布,1：发布；0：不发布
  delete_datetime timestamp with time zone,
  create_date date, -- 创建日期
  memo character(200), -- 说明
  CONSTRAINT ec_zw_ad_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ec_zw_ad
  OWNER TO postgres;
COMMENT ON TABLE ec_zw_ad
  IS '广告';
COMMENT ON COLUMN ec_zw_ad.id IS '自增长编号';
COMMENT ON COLUMN ec_zw_ad.pic_url IS '图片地址';
COMMENT ON COLUMN ec_zw_ad.link_url IS '链接跳转地址';
COMMENT ON COLUMN ec_zw_ad."position" IS '排序编号';
COMMENT ON COLUMN ec_zw_ad.pub_flg IS '是否发布,1：发布；0：不发布';
COMMENT ON COLUMN ec_zw_ad.create_date IS '创建日期';
COMMENT ON COLUMN ec_zw_ad.memo IS '说明';


------------------
-- Table: ec_zw_store_rank

-- DROP TABLE ec_zw_store_rank;

CREATE TABLE ec_zw_store_rank
(
  id serial NOT NULL, -- 自增长编号
  name character(200), -- 商品名称
  counts integer, -- 销量
  url character(200), -- 产品链接
  delete_datetime date, -- 删除时间
  pub_flg integer DEFAULT 0, -- 是否发布
  create_datetime timestamp with time zone, -- 创建时间
  CONSTRAINT ec_zw_store_rank_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ec_zw_store_rank
  OWNER TO postgres;
COMMENT ON TABLE ec_zw_store_rank
  IS '实体店销售排行';
COMMENT ON COLUMN ec_zw_store_rank.id IS '自增长编号';
COMMENT ON COLUMN ec_zw_store_rank.name IS '商品名称';
COMMENT ON COLUMN ec_zw_store_rank.counts IS '销量';
COMMENT ON COLUMN ec_zw_store_rank.url IS '产品链接';
COMMENT ON COLUMN ec_zw_store_rank.delete_datetime IS '删除时间';
COMMENT ON COLUMN ec_zw_store_rank.pub_flg IS '是否发布';
COMMENT ON COLUMN ec_zw_store_rank.create_datetime IS '创建时间';

----------------------

-- Table: ec_zw_user_history

-- DROP TABLE ec_zw_user_history;

CREATE TABLE ec_zw_user_history
(
  id serial NOT NULL, -- 自增长编号
  user_id integer, -- 用户编号
  product_cd character(15), -- 产品编号
  CONSTRAINT ec_zw_user_history_pkey PRIMARY KEY (id),
  CONSTRAINT a FOREIGN KEY (product_cd)
      REFERENCES ec_product (product_cd) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ec_zw_user_history
  OWNER TO postgres;
COMMENT ON TABLE ec_zw_user_history
  IS '用户产品浏览记录';
COMMENT ON COLUMN ec_zw_user_history.id IS '自增长编号';
COMMENT ON COLUMN ec_zw_user_history.user_id IS '用户编号';
COMMENT ON COLUMN ec_zw_user_history.product_cd IS '产品编号';