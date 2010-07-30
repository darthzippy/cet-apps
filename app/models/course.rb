class Course < ActiveRecord::Base
    
  validates_uniqueness_of :source, :on => :create, :message => "must be unique"
  
  def self.search(search, page)
    paginate :per_page => 15, :page => page,
             :conditions => ['source like ?', "%#{search}%"],
             :order => 'destination ASC'
  end
  
  named_scope :summer, :conditions => ["destination LIKE ? OR destination LIKE ?", '%SST%', '%2009MA%']
  named_scope :fall, :conditions => ["destination LIKE ?", '%2010FA%']
end
